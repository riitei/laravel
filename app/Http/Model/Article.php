<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    const CREATED_AT = 'art_time';
    const UPDATED_AT = 'art_update_date';
    // http://laravelacademy.org/post/6979.html
    protected $table = 'article';//art_create_date
    protected $primaryKey = 'art_id';
// 如果你需要自定义用于存储时间戳的字段名称，可以在模型中设置 CREATED_AT 和 UPDATED_AT 常量：
    protected $guarded = ['cate_pid'];
    /* $fillable 就像是可以被赋值属性的“白名单”，还可以选择使用 $guarded。
     ＊ $guarded 属性包含你不想被赋值的属性数组。所以不被包含在其中的属性都是可以被赋值的，
     ＊ 因此，$guarded 功能就像“黑名单”。
     ＊ 当然，这两个属性你只能同时使用其中一个——而不能一起使用，
     ＊ 因为它们是互斥的。下面的例子中，除了 price 之外的所有属性都是可以赋值的：
    */
}
