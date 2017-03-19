<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // 數據遷移 http://laravelacademy.org/post/6964.html
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('link_id');
            $table->string('link_name')->default('')->comment('// 名稱');// vcher
            $table->string('link_title')->default('')->comment('// 標題');// vcher
            $table->string('link_url')->default('')->comment('// 連結');// vcher
            $table->string('link_order')->default('0')->comment('// 排序');// vcher
            $table->dateTime('link_create_date');
            $table->dateTime('link_update_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
