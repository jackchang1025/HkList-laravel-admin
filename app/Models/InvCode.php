<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property int $group_id
 * @property string $name
 * @property int $can_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Group $group
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 * @property-read int|null $user_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvCode onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvCode query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvCode whereCanCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvCode whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvCode whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvCode whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvCode withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvCode withoutTrashed()
 * @mixin \Eloquent
 */
class InvCode extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "group_id",
        "name",
        "use_count",
        "can_count",
    ];

    public function group()
    {
        return $this->belongsTo(Group::class)->withTrashed();
    }

    public function user()
    {
        return $this->hasMany(User::class)->withTrashed();
    }
}
