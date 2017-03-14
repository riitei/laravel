<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'cate_id';


    public function tree()
    {
        $category = $this::all();

        return $this->getTree($category, 'cate_id', 'cate_pid', 0, 'cate_name');
    }
//    相同寫法
//    public static function tree()
//    {
//        $category = Category::all();
//
//        return (new Category)->getTree($category, 'cate_id', 'cate_pid', 0, 'cate_name');
//    }

    public function getTree($category, $db_table_name_id = 'id', $db_table_name_pid = 'pid',
                            $db_table_name_pid_default = 0, $db_table_name_name)
    {
        $cate_array = array();
        foreach ($category as $key_id => $id_value) {
            // pid=0 分類標題
            if ($id_value->$db_table_name_pid == $db_table_name_pid_default) {
                $cate_array[] = $category[$key_id];
                $category[$key_id]['_' . $db_table_name_name] = $category[$key_id][$db_table_name_name];

                // 標題
                foreach ($category as $key_pid => $pid_value) {
                    if ($pid_value->$db_table_name_pid == $id_value->$db_table_name_id) {
                        $category[$key_pid]['_' . $db_table_name_name] = '├─ ' . $category[$key_pid][$db_table_name_name];
                        $cate_array[] = $category[$key_pid];
                    }
                }
            }
        }
        return $cate_array;
    }
}
