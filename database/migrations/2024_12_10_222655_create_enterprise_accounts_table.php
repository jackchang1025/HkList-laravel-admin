<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enterprise_accounts', function (Blueprint $table) {
            $table->id();
            $table->text('cookie')->comment('百度网盘企业账号Cookie凭证');
            $table->string('cid', 191)->comment('企业账号的唯一标识符');
            $table->string('bdstoken', 191)->comment('百度网盘的安全令牌');
            $table->string('surl', 191)->comment('分享链接的短链接标识');
            $table->string('pwd', 32)->nullable()->comment('分享链接的提取密码');
            $table->string('path', 191)->comment('文件在企业网盘中的存储路径');
            $table->boolean('is_active')->default(true)->comment('账号是否处于激活状态');
            $table->timestamps();
            $table->softDeletes();
            
            // 添加唯一索引
            $table->unique('cid');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enterprise_accounts');
    }
};