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
 * @property int $mode
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ip newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ip newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ip query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ip whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ip whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ip whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ip whereMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ip whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ip extends Model
{
    use HasFactory;

    protected $fillable = [
        "ip",
        "mode",
        "switch"
    ];
}
