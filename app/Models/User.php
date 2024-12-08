<?php

namespace App\Models;

use App\Http\Controllers\UtilsController;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property int $inv_code_id
 * @property string $username
 * @property string $password
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Group|null $group
 * @property-read \App\Models\InvCode $inv_code
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Record> $records
 * @property-read int|null $records_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereInvCodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutTrashed()
 * @mixin Eloquent
 * @mixin Eloquent
 */
class User extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "inv_code_id",
        "username",
        "password",
        "role",
    ];

    public static function getDefaultQuotaInfo(): array
    {
        $group = Group::withTrashed()->find(1);
        if (!$group) {
            return [];
        }

        $records = Record::query()
            ->where([
                "user_id" => 1,
                "ip"      => UtilsController::getIp(),
            ])
            ->whereDate("records.created_at", now())
            ->leftJoin("file_lists", "file_lists.id", "=", "records.fs_id")
            ->selectRaw("SUM(file_lists.size) as size, COUNT(*) as count")
            ->first();

        return self::calculateQuota($group, $records);
    }

    /**
     * 将 GB 转换为字节
     *
     * @param float $gb GB大小
     * @return int 字节数
     */
    protected static function gbToBytes(float $gb): int
    {
        return (int)($gb * 1073741824);
    }

    public function inv_code()
    {
        return $this->belongsTo(InvCode::class)->withTrashed();
    }

    public function group()
    {
        return $this->hasOneThrough(Group::class, InvCode::class, "id", "id", "inv_code_id", "group_id")->withTrashed(
        )->withTrashedParents();
    }

    public function records()
    {
        return $this->hasMany(Record::class)->withTrashed();
    }

    /**
     * 获取用户组和剩余配额信息
     *
     * @return array
     */
    public function getQuotaInfo(): array
    {
        if (!$this->group) {
            return [];
        }

        $records = Record::query()
            ->where([
                "user_id" => $this->id,
                "ip"      => UtilsController::getIp(),
            ])
            ->whereDate("records.created_at", now())
            ->leftJoin("file_lists", "file_lists.id", "=", "records.fs_id")
            ->selectRaw("SUM(file_lists.size) as size, COUNT(*) as count")
            ->first();

        return self::calculateQuota($this->group, $records);
    }

    /**
     * 计算剩余配额
     *
     * @param Group $group 用户组信息
     * @param Record $records 使用记录
     * @return array 返回配额详细信息
     */
    private static function calculateQuota(Group $group, Record $records): array
    {
        $totalSize     = $group['size'] * 1073741824; // GB 转换为字节
        $usedCount     = min($records['count'] ?? 0, $group['count']);
        $usedSize      = min($records['size'] ?? 0, $totalSize);
        $remainingSize = max(0, $totalSize - $usedSize);

        return [
            'group_name'      => $group['name'],          // 用户组名称
            'remaining_count' => max(0, $group['count'] - $usedCount),  // 剩余可用次数，不允许为负
            'remaining_size'  => self::formatSize($remainingSize),      // 剩余可用空间（GB）
            'total_count'     => $group['count'],        // 总允许解析次数
            'total_size'      => self::formatSize($totalSize),             // 总允许使用空间（GB）
            'used_count'      => $usedCount,              // 已使用的解析次数
            'used_size'       => self::formatSize($usedSize),               // 已使用的空间（GB）

        ];
    }

    /**
     * 将字节转换为 GB 并格式化
     *
     * @param int $bytes 字节数
     * @return string 格式化后的大小（GB）
     */
    protected static function formatSize(int $bytes): string
    {
        $gb = $bytes / 1073741824; // 1073741824 = 1024 * 1024 * 1024

        return number_format($gb, 2).' GB';
    }
}
