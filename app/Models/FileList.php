<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $surl
 * @property string $pwd
 * @property int $fs_id
 * @property int $size
 * @property string $filename
 * @property string $md5
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileList query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileList whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileList whereFsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileList whereMd5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileList wherePwd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileList whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileList whereSurl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileList whereUpdatedAt($value)
 * @mixin Eloquent
 * @mixin Eloquent
 */
class FileList extends Model
{
    use HasFactory;

    protected $fillable = [
        "surl",
        "pwd",
        "fs_id",
        "size",
        "filename",
        "md5"
    ];
}
