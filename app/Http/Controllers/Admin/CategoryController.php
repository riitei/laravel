<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Model\Category;

class CategoryController extends Controller
{
// php artisan route:list
// |Domain | Method     | URI                             | Name             | Action                                                                 | Middleware           |
// |       | POST       | admin/category                  | category.store   | App\Http\Controllers\admin\CategoryController@store                    | web,admin_login      |
// |       | GET|HEAD   | admin/category                  | category.index   | App\Http\Controllers\admin\CategoryController@index                    | web,admin_login      |
// |       | GET|HEAD   | admin/category/create           | category.create  | App\Http\Controllers\admin\CategoryController@create                   | web,admin_login      |
// |       | DELETE     | admin/category/{category}       | category.destroy | App\Http\Controllers\admin\CategoryController@destroy                  | web,admin_login      |
// |       | PUT|PATCH  | admin/category/{category}       | category.update  | App\Http\Controllers\admin\CategoryController@update                   | web,admin_login      |
// |       | GET|HEAD   | admin/category/{category}       | category.show    | App\Http\Controllers\admin\CategoryController@show                     | web,admin_login      |
// |       | GET|HEAD   | admin/category/{category}/edit  | category.edit    | App\Http\Controllers\admin\CategoryController@edit                     | web,admin_login      |
//-----
    // post admin/category
    public function store()
    {

    }

    // get admin/category 全部分類列表
    public function index()
    {

//        $data = new Category();
//        $data = $data->tree();
        $data = (new Category)->tree();
        //
//        $data = Category::tree();
        return view('admin.category.index')->with('data', $data);
    }

    // get admin/category/create 添加分類
    public function create()
    {

    }

    // DELETE admin/category/{category}  {參數} 刪除單個分類
    public function destroy()
    {

    }

    // put admin/category/{category} 更新分類
    public function update()
    {

    }

    // get admin/category/{category} 顯示單個分類訊息
    public function show()
    {

    }

    // get admin/category/{category}/edit 編輯分類
    public function edit()
    {

    }
}
