<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const CREATED_AT = 'cate_create_date';
    const UPDATED_AT = 'cate_update_date';
    //  http://laravelacademy.org/post/6979.html
    protected $table = 'category';
    /* $fillable 就像是可以被赋值属性的“白名单”，还可以选择使用 $guarded。
     ＊ $guarded 属性包含你不想被赋值的属性数组。所以不被包含在其中的属性都是可以被赋值的，
     ＊ 因此，$guarded 功能就像“黑名单”。
     ＊ 当然，这两个属性你只能同时使用其中一个——而不能一起使用，
     ＊ 因为它们是互斥的。下面的例子中，除了 price 之外的所有属性都是可以赋值的：
     */

// 如果你需要自定义用于存储时间戳的字段名称，可以在模型中设置 CREATED_AT 和 UPDATED_AT 常量：
    protected $primaryKey = 'cate_id';
    protected $guarded = [];
//排除新增

    public function tree()
    {
        $category = $this->orderBy('cate_order', 'asc')->get();
        //$category = Category::orderBy('cate_order','asc')->get();
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
