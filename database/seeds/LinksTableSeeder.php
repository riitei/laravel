<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [

                'link_name' => 'Laravel 5.4 中文文档',
                'link_title' => 'laravel',
                'link_url' => 'http://laravelacademy.org/laravel-docs-5_4',
                'link_order' => 1,
                'link_create_date' => date("Y-m-d H:i:s")

            ],

            [

                'link_name' => 'Laravel 5.2 中文文档',
                'link_title' => 'laravel',
                'link_url' => 'http://laravelacademy.org/laravel-docs-5_2',
                'link_order' => 2,
                'link_create_date' => date("Y-m-d H:i:s")

            ]
        ];
        DB::table('links')->insert($data);
        // 需要再 DatabaseSeeder.php 添加
        // $this->call(LinksTableSeeder::class);
        // 執行 填充 php artisan db:seed
    }
}
