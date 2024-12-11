<?php

namespace App\Services;

use App\Models\Token;
use App\Models\User;
use App\Models\Record;
use App\Http\Controllers\UtilsController;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\Group;

class QuotaService
{
    private const BYTES_PER_GB = 1073741824; // 1024 * 1024 * 1024

    private array $quotaInfo = [];
    private Token|User|null $model;
    private array $usage = [];
    private array $quota = [];

    public function __construct(Token|User|null $model = null)
    {
        $this->model = $model;
        $this->initializeQuota();
    }

    public function getQuotaInfo(): array
    {
        return $this->quotaInfo;
    }


    /**
     * 创建配额服务实例
     *
     * @param Token|User|null $model
     * @return static
     */
    public static function make(Token|User|null $model = null): self
    {
        return new self($model);
    }

    /**
     * 初始化配额信息
     */
    private function initializeQuota(): void
    {
        // 获取使用记录
        $this->usage = $this->getUsageRecords();
        
        // 设置配额
        $this->quota = $this->getQuotaLimits();
        
        // 计算配额信息
        $this->calculateQuota();
    }

    /**
     * 获取使用记录
     */
    private function getUsageRecords(): array
    {
        $query = Record::query()
            ->whereDate('records.created_at', now())
            ->leftJoin('file_lists', 'file_lists.id', '=', 'records.fs_id')
            ->selectRaw('SUM(file_lists.size) as size, COUNT(*) as count');

        if ($this->model instanceof Token) {

            $query->where('token_id', $this->model->id);
        } elseif ($this->model instanceof User) {

            $query->where([
                'user_id' => $this->model->id,
                'ip' => UtilsController::getIp(),
            ]);

        }else if($this->model === null){
            $query->where([
                'user_id' => 1,
                'ip' => UtilsController::getIp(),
            ]);
        }

        $records = $query->first();

        return [
            'size' => $records['size'] ?? 0,
            'count' => $records['count'] ?? 0
        ];
    }

    /**
     * 获取配额限制
     */
    private function getQuotaLimits(): array
    {
        if ($this->model instanceof Token) {
            return [
                'size' => $this->model->size,
                'count' => $this->model->count
            ];
        }

        if ($this->model instanceof User && $this->model->group) {
            return [
                'size' => $this->model->group->size,
                'count' => $this->model->group->count
            ];
        }


        if($this->model === null){
            $group = Group::withTrashed()->find(1);
            if ($group){
                return $group->only('size','count');
            }
        }

        return ['size' => 0, 'count' => 0];
    }

    /**
     * 计算配额信息
     */
    private function calculateQuota(): void
    {
        $totalSize = $this->quota['size'] * self::BYTES_PER_GB;
        $usedSize = min($this->usage['size'], $totalSize);
        $usedCount = min($this->usage['count'], $this->quota['count']);

        $this->quotaInfo = [
            'total_size' => $totalSize,//总文件大小
            'total_size_format' => $this->formatSize($totalSize),//总文件大小格式化
            'total_count' => $this->quota['count'],//总下载次数
            
            'used_size' => $usedSize,//已使用文件大小
            'used_size_format' => $this->formatSize($usedSize),//已使用文件大小格式化
            'used_count' => $usedCount,//已使用下载次数
            
            'remaining_size' => max(0, $totalSize - $usedSize),//剩余文件大小
            'remaining_size_format' => $this->formatSize(max(0, $totalSize - $usedSize)),//剩余文件大小格式化
            'remaining_count' => max(0, $this->quota['count'] - $usedCount),//剩余下载次数
            
            'group_name' => $this->getGroupName()//组名
        ];


        // 如果是 Token 模型，添加过期时间
        $this->quotaInfo['expired_at'] = $this->model?->expired_at ?? '未使用';
    }

    /**
     * 获取组名
     */
    private function getGroupName(): string
    {
        if ($this->model instanceof Token) {
            return $this->model->name;
        }

        if ($this->model instanceof User && $this->model->group) {
            return $this->model->group->name;
        }

        if($this->model === null){
            $group = Group::withTrashed()->find(1);
            if ($group){
                return $group->name;
            }
        }

        return '';
    }

    /**
     * 转换为数组
     */
    public function toArray(): array
    {
        return $this->quotaInfo;
    }

    /**
     * 检查是否过期
     */
    public function isExpired(): bool
    {
        if (!($this->model instanceof Token)) {
            return false;
        }

        if($this->model->expired_at){   
            return Carbon::parse($this->model->expired_at)->isPast();
        }

        return false;
    }

    /**
     * 检查次数是否用完
     */
    public function isUsedUp(): bool
    {
        return $this->quotaInfo['remaining_count'] <= 0;
    }

    /**
     * 检查文件大小是否用完
     */
    public function isFileSizeUsedUp(): bool
    {
        return $this->quotaInfo['remaining_size'] <= 0;
    }

    public function checkIp(string $ip): bool
    {
        if($this->model->ip){
            return $this->model->ip === $ip;
        }
        return true;
    }

    /**
     * 检查是否所有配额都用完或过期
     */
    public function isAllUsedUp(): bool
    {
        return $this->isExpired() || $this->isUsedUp() || $this->isFileSizeUsedUp();
    }

    /**
     * 获取剩余下载次数
     */
    public function getRemainingCount(): int
    {
        return $this->quotaInfo['remaining_count'];
    }

    /**
     * 获取剩余文件大小（格式化）
     */
    public function getRemainingSizeFormat(): string
    {
        return $this->quotaInfo['remaining_size_format'];
    }

    /**
     * 获取剩余文件大小（字节）
     */
    public function getRemainingSize(): int
    {
        return $this->quotaInfo['remaining_size'];
    }

    /**
     * 格式化文件大小
     */
    private function formatSize(int $size): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $index = 0;
        while ($size >= 1024 && $index < count($units) - 1) {
            $size /= 1024;
            $index++;
        }
        return round($size, 2) . ' ' . $units[$index];
    }
} 