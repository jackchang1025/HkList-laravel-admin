<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * 请求记录模型
 *
 * @property int $id 自增ID
 * @property string $ip IP地址
 * @property string $password 访问密码
 * @property string|null $user 用户标识
 * @property string|null $cookie Cookie信息
 * @property \Carbon\Carbon $addtime 添加时间
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereCookie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereAddtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Request newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Request newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Request query()
 * @mixin \Eloquent
 */
class Request extends Model
{
    /**
     * 与模型关联的表名
     *
     * @var string
     */
    protected $table = 'request';

    /**
     * 指示模型是否自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 可以批量赋值的属性
     *
     * @var array
     */
    protected $fillable = [
        'ip',
        'password',
        'user',
        'cookie',
        'addtime'
    ];

    /**
     * 应该被转换的属性
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'addtime' => 'datetime'
    ];

    /**
     * 获取今日请求次数
     *
     * @param string $ip
     * @return int
     */
    public static function getTodayRequestCount(string $ip): int
    {
        return static::where('ip', $ip)
            ->whereDate('addtime', Carbon::today())
            ->count();
    }

    /**
     * 获取用户今日请求次数
     *
     * @param string $user
     * @return int
     */
    public static function getTodayUserRequestCount(string $user): int
    {
        return static::where('user', $user)
            ->whereDate('addtime', Carbon::today())
            ->count();
    }

    /**
     * 记录新的请求
     *
     * @param string $ip
     * @param string $password
     * @param string|null $user
     * @param string|null $cookie
     * @return self
     */
    public static function recordRequest(
        string $ip,
        string $password,
        ?string $user = null,
        ?string $cookie = null
    ): self {
        return static::create([
            'ip' => $ip,
            'password' => $password,
            'user' => $user,
            'cookie' => $cookie,
            'addtime' => Carbon::now()
        ]);
    }
}