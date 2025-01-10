<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable = [
        'keyword',
        'match_type', 
        'description',
        'is_active'
    ];

    // 匹配规则常量
    const MATCH_TYPE_CONTAINS = 'contains';
    const MATCH_TYPE_EQUALS = 'equals'; 
    const MATCH_TYPE_NOT_EQUALS = 'not_equals';

    // 获取所有可用的匹配规则
    public static function getMatchTypes()
    {
        return [
            self::MATCH_TYPE_CONTAINS => '包含',
            self::MATCH_TYPE_EQUALS => '等于',
            self::MATCH_TYPE_NOT_EQUALS => '不等于'
        ];
    }

    // 检查文件名是否匹配关键词
    public function isMatch($filename)
    {
        // 确保使用UTF-8编码
        $filename = mb_convert_encoding($filename, 'UTF-8', 'auto');
        $keyword = mb_convert_encoding($this->keyword, 'UTF-8', 'auto');
        
        switch($this->match_type) {
            case self::MATCH_TYPE_CONTAINS:
                return mb_stripos($filename, $keyword) !== false;
            case self::MATCH_TYPE_EQUALS:
                return mb_strtolower($filename) === mb_strtolower($keyword);
            case self::MATCH_TYPE_NOT_EQUALS:
                return mb_strtolower($filename) !== mb_strtolower($keyword);
            default:
                return false;
        }
    }
} 