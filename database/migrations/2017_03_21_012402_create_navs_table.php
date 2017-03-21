<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // 建立此頁面  php artisan make:migration create_links_table

    public function up()
    {
        Schema::create('navs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('nav_id');
            $table->string('nav_name_tw')->default('')->nullable()->comment('nav_name 中文');// varchar
            $table->string('nav_name_en')->default('')->nullable()->comment('nav_name 英文');// varchar
            $table->string('nav_url')->default('')->nullable()->comment('連結');// varchar
            $table->string('nav_order')->default('0')->comment('');// varchar
            $table->dateTime('nav_create_date')->nullable();
            $table->dateTime('nav_update_date')->nullable();
        });
    }

    // 執行 資料遷移 php artisan migrate

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('navs'); // 刪除
    }
}
