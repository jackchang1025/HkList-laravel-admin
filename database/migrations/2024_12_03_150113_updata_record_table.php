<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        ///*!40101 SET character_set_client = utf8 */;
        //CREATE TABLE `records` (
        //  `id` int(11) NOT NULL AUTO_INCREMENT,
        //  `time` datetime NOT NULL,
        //  `size` bigint(20) NOT NULL,
        //  `name` varchar(255) NOT NULL,
        //  `link` text NOT NULL,
        //  `md5` varchar(255) NOT NULL,
        //  `ip` varchar(255) NOT NULL,
        //  `ua` varchar(255) NOT NULL,
        //  `account` int(11) NOT NULL,
        //  `user` varchar(255) DEFAULT NULL,
        //  `cookie` text,
        //  `useraccount` varchar(255) DEFAULT NULL,
        //  `province` varchar(50) NOT NULL COMMENT '省份',
        //  PRIMARY KEY (`id`)
        //) ENGINE=InnoDB AUTO_INCREMENT=3412 DEFAULT CHARSET=utf8;
        ///*!40101 SET character_set_client = @saved_cs_client */;
        ///
        ///
        Schema::table('records', function (Blueprint $table) {

            $table->dateTime('time')->nullable();
            $table->bigInteger('size')->nullable();
            $table->string('name')->nullable();
            $table->string('md5')->nullable();
            $table->string('user')->nullable();
            $table->string('province')->nullable();
            $table->string('useraccount')->nullable();
            $table->longText('link')->nullable();
            $table->longText('cookie')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('records', function (Blueprint $table) {

            $table->dropColumn('time');
            $table->dropColumn('size');
            $table->dropColumn('name');
            $table->dropColumn('md5');
            $table->dropColumn('user');
            $table->dropColumn('province');
            $table->dropColumn('useraccount');
            $table->dropColumn('link');
            $table->dropColumn('cookie');
        });
    }
};
