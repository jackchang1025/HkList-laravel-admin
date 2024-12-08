<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property string $ip
 * @property int $fs_id
 * @property string $url
 * @property string $ua
 * @property int|null $user_id
 * @property int|null $token_id
 * @property int $account_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $time
 * @property int|null $size
 * @property string|null $name
 * @property string|null $md5
 * @property string|null $user
 * @property string|null $province
 * @property string|null $useraccount
 * @property string|null $link
 * @property string|null $cookie
 * @property-read \App\Models\FileList|null $file
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record whereCookie($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record whereFsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record whereMd5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record whereTokenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record whereUa($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record whereUseraccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Record withoutTrashed()
 * @mixin \Eloquent
 */
class Record extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "ip",
        "fs_id",
        "url",
        "ua",
        "user_id",
        "token_id",
        "account_id"
    ];

    public function file()
    {
        return $this->hasOne(FileList::class, "id", "fs_id");
    }
}
