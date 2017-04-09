<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // 建立此頁面  php artisan make:migration create_links_table

    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('conf_id');
            $table->string('conf_title')->nullable();// varchar
            $table->string('conf_name')->nullable();// varchar
            $table->string('conf_content')->nullable()->comment('連結');// varchar
            $table->string('conf_order')->default('0')->comment('');// varchar
            $table->string('conf_tips')->comment('描述');// varchar
            $table->string('field_type')->comment('字段_類型');// varchar
            $table->string('field_value')->comment('字段_值');// varchar
            $table->dateTime('conf_create_date')->nullable();
            $table->dateTime('conf_update_date')->nullable();
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
        Schema::drop('config'); // 刪除
    }

}
