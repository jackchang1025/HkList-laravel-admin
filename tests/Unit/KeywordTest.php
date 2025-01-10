<?php

namespace Tests\Unit;

use App\Models\Keyword;
use Tests\TestCase;

class KeywordTest extends TestCase
{
    /**
     * 测试包含匹配规则
     * @dataProvider containsMatchProvider
     */
    public function testContainsMatch($keyword, $filename, $expectedResult)
    {
        $keywordModel = new Keyword([
            'keyword' => $keyword,
            'match_type' => Keyword::MATCH_TYPE_CONTAINS
        ]);

        $this->assertEquals($expectedResult, $keywordModel->isMatch($filename));
    }

    public function containsMatchProvider()
    {
        return [
            // 基本英文测试
            ['test', 'test_file.txt', true],
            ['TEST', 'test_file.txt', true], // 大小写不敏感
            ['xyz', 'test_file.txt', false],
            
            // 中文测试
            ['测试', '这是测试文件.txt', true],
            ['测试', '这是test文件.txt', false],
            
            // 日文测试
            ['テスト', 'テストファイル.txt', true],
            ['てすと', 'テストファイル.txt', false],
            ['テスト', '测试テストtest.txt', true],
            
            // 韩文测试
            ['테스트', '테스트파일.txt', true],
            ['테스트', 'テストファイル.txt', false],
            
            // 混合语言测试
            ['test测试', 'test测试文件.txt', true],
            ['テストtest', 'テストtest文件.txt', true],
        ];
    }

    /**
     * 测试完全相等匹配规则
     * @dataProvider equalsMatchProvider
     */
    public function testEqualsMatch($keyword, $filename, $expectedResult)
    {
        $keywordModel = new Keyword([
            'keyword' => $keyword,
            'match_type' => Keyword::MATCH_TYPE_EQUALS
        ]);

        $this->assertEquals($expectedResult, $keywordModel->isMatch($filename));
    }

    public function equalsMatchProvider()
    {
        return [
            // 基本英文测试
            ['test.txt', 'test.txt', true],
            ['TEST.txt', 'test.txt', true], // 大小写不敏感
            ['test.txt', 'test2.txt', false],
            
            // 中文测试
            ['测试.txt', '测试.txt', true],
            ['测试.txt', '测试2.txt', false],
            
            // 日文测试
            ['テスト.txt', 'テスト.txt', true],
            ['テスト.txt', 'てすと.txt', false],
            
            // 韩文测试
            ['테스트.txt', '테스트.txt', true],
            ['테스트.txt', '테스트2.txt', false],
        ];
    }

    /**
     * 测试不等于匹配规则
     * @dataProvider notEqualsMatchProvider
     */
    public function testNotEqualsMatch($keyword, $filename, $expectedResult)
    {
        $keywordModel = new Keyword([
            'keyword' => $keyword,
            'match_type' => Keyword::MATCH_TYPE_NOT_EQUALS
        ]);

        $this->assertEquals($expectedResult, $keywordModel->isMatch($filename));
    }

    public function notEqualsMatchProvider()
    {
        return [
            // 基本英文测试
            ['test.txt', 'test2.txt', true],
            ['TEST.txt', 'test.txt', false], // 大小写不敏感
            
            // 中文测试
            ['测试.txt', '测试2.txt', true],
            ['测试.txt', '测试.txt', false],
            
            // 日文测试
            ['テスト.txt', 'てすと.txt', true],
            ['テスト.txt', 'テスト.txt', false],
        ];
    }

    /**
     * 测试特殊情况
     * @dataProvider specialCasesProvider
     */
    public function testSpecialCases($matchType, $keyword, $filename, $expectedResult)
    {
        $keywordModel = new Keyword([
            'keyword' => $keyword,
            'match_type' => $matchType
        ]);

        $this->assertEquals($expectedResult, $keywordModel->isMatch($filename));
    }

    public function specialCasesProvider()
    {
        return [
            // 空字符串测试
            [Keyword::MATCH_TYPE_CONTAINS, '', 'test.txt', true],
            [Keyword::MATCH_TYPE_EQUALS, '', '', true],
            
            // 特殊字符测试
            [Keyword::MATCH_TYPE_CONTAINS, '!@#$', 'test!@#$file.txt', true],
            [Keyword::MATCH_TYPE_CONTAINS, '\\', 'test\\file.txt', true],
            
            // 无效的匹配规则
            ['invalid_type', 'test', 'test.txt', false],
            
            // 超长字符串测试
            [Keyword::MATCH_TYPE_CONTAINS, str_repeat('a', 255), str_repeat('a', 1000), true],
        ];
    }

    /**
     * 测试编码相关情况
     * @dataProvider encodingTestProvider
     */
    public function testEncoding($keyword, $filename, $expectedResult)
    {
        $keywordModel = new Keyword([
            'keyword' => $keyword,
            'match_type' => Keyword::MATCH_TYPE_CONTAINS
        ]);

        $this->assertEquals($expectedResult, $keywordModel->isMatch($filename));
    }

    public function encodingTestProvider()
    {
        return [
            // UTF-8编码测试
            ['测试', mb_convert_encoding('测试文件.txt', 'UTF-8'), true],
            ['テスト', mb_convert_encoding('テストファイル.txt', 'UTF-8'), true],
            ['테스트', mb_convert_encoding('테스트파일.txt', 'UTF-8'), true],
            
            // 混合编码测试
            ['test测试', mb_convert_encoding('test测试file.txt', 'UTF-8'), true],
            ['テストtest', mb_convert_encoding('テストtestファイル.txt', 'UTF-8'), true],
        ];
    }
} 