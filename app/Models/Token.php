<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property int $count
 * @property int $size
 * @property int $day
 * @property string|null $ip
 * @property string|null $expired_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Record> $records
 * @property-read int|null $records_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Token newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Token newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Token onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Token query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Token whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Token whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Token whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Token whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Token whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Token whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Token whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Token whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Token whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Token whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Token withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Token withoutTrashed()
 * @mixin \Eloquent
 */
class Token extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "name",
        "count",
        "size",
        "day",
        "expired_at",
        "ip"
    ];

    public function records()
    {
        return $this->hasMany(Record::class)->withTrashed();
    }

    public function getQuotaInfo():array
    {

        // 获取token的使用记录
        $records = Record::query()
        ->where('token_id', $this->id)
        ->whereDate('records.created_at', now()) // 明确指定表名
        ->leftJoin('file_lists', 'file_lists.id', '=', 'records.fs_id')
        ->selectRaw('SUM(size) as size, COUNT(*) as count')
        ->first();

        $usedCount = $records['count'] ?? 0;
        $usedSize = $records['size'] ?? 0;
        $remainingCount = $this->count - $usedCount;
        $remainingSize = ($this->size * 1073741824) - $usedSize;

        $quotaInfo = [
            'group_name' => $this->name,
            'remaining_count' => $remainingCount,
            'remaining_size' => $this->formatSize($remainingSize),
            'used_count' => $usedCount,
            'used_size' => $this->formatSize($usedSize),
            'total_count' => $this->count,
            'total_size' => $this->formatSize($this->size * 1073741824),
            'expired_at' => $this->expired_at ?? '未使用'
        ];

        return $quotaInfo;
    }

       /**
     * 格式化文件大小
     *
     * @param int $size 字节数
     * @return string
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
