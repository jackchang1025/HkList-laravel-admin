<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('request', function (Blueprint $table) {
            $table->id();                                    // 自增ID
            $table->string('ip', 45)->comment('IP地址');      // IPv6最长45个字符
            $table->string('password', 100)->comment('访问密码');   // 访问密码
            $table->string('user', 100)->nullable()->comment('用户标识'); // 用户标识
            $table->text('cookie')->nullable()->comment('Cookie信息'); // Cookie信息
            $table->timestamp('addtime')->comment('添加时间');  // 添加时间

            // 创建索引，限制索引长度
            $table->index('ip');
            $table->index('password');
            $table->index('user');
            $table->index('addtime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request');
    }
};
