<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 企业网盘账号模型
 * 
 * @property int $id 主键ID
 * @property string $cookie Cookie凭证
 * @property string $cid 企业账号ID
 * @property string $bdstoken 安全令牌
 * @property string $surl 分享短链接
 * @property string|null $pwd 提取密码
 * @property string $path 存储路径
 * @property boolean $is_active 是否激活
 * @property \Carbon\Carbon $created_at 创建时间
 * @property \Carbon\Carbon $updated_at 更新时间
 */
class EnterpriseAccount extends Model
{
    protected $fillable = [
        'name',
        'cookie',
        'cid',
        'bdstoken',
        'surl',
        'pwd',
        'path',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * 获取活跃的企业账号
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}