<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property string $baidu_name
 * @property string $account_type
 * @property string|null $cookie
 * @property string|null $uk
 * @property string|null $access_token
 * @property string|null $refresh_token
 * @property int|null $cid
 * @property string|null $expired_at
 * @property string $vip_type
 * @property int $switch
 * @property string|null $reason
 * @property string|null $prov
 * @property string|null $svip_end_at
 * @property string|null $last_use_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Record> $records
 * @property-read int|null $records_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereAccountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereBaiduName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereCid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereCookie($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereLastUseAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereProv($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereSvipEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereSwitch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereVipType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account withoutTrashed()
 * @mixin Eloquent
 * @mixin Eloquent
 */
class Account extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "id",
        "baidu_name",
        "account_type",
        "cookie",
        "access_token",
        "refresh_token",
        "cid",
        "expired_at",
        "vip_type",
        "switch",
        "reason",
        "prov",
        "svip_end_at",
        "last_use_at",
        "uk"
    ];

    public function records()
    {
        return $this->hasMany(Record::class)->withTrashed();
    }
}
