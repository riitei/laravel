<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // 建立此頁面  php artisan make:migration create_links_table

    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('link_id');
            $table->string('link_name')->default('')->comment('名稱');// varchar
            $table->string('link_title')->default('')->comment('標題');// varchar
            $table->string('link_url')->default('')->comment('連結');// varchar
            $table->string('link_order')->default('0')->comment('');// varchar
            $table->dateTime('link_create_date')->nullable();
            $table->dateTime('link_update_date')->nullable();
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
        Schema::drop('links'); // 刪除
    }
}
