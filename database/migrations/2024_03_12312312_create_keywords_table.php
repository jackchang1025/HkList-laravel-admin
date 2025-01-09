<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('keywords', function (Blueprint $table) {
            $table->id();
            $table->string('keyword')->comment('关键词');
            $table->string('match_type')->comment('匹配规则:contains,equals,not_equals');
            $table->string('description')->nullable()->comment('描述');
            $table->boolean('is_active')->default(true)->comment('是否启用');
            $table->timestamps();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('keywords');
    }
}; 