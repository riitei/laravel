<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

class ArticleController extends CommonController
{
//----資源路由 開始
//
// php artisan route:list
// |Domain | Method     | URI                           | Name            | Action                                               | Middleware           |
// |       | POST       | admin/article                 | article.store   | App\Http\Controllers\admin\articleController@store   | web,admin_login      |
// |       | GET|HEAD   | admin/article                 | article.index   | App\Http\Controllers\admin\articleController@index   | web,admin_login      |
// |       | GET|HEAD   | admin/article/create          | article.create  | App\Http\Controllers\admin\articleController@create  | web,admin_login      |
// |       | DELETE     | admin/article/{article}       | article.destroy | App\Http\Controllers\admin\articleController@destroy | web,admin_login      |
// |       | PUT|PATCH  | admin/article/{article}       | article.update  | App\Http\Controllers\admin\articleController@update  | web,admin_login      |
// |       | GET|HEAD   | admin/article/{article}       | article.show    | App\Http\Controllers\admin\articleController@show    | web,admin_login      |
// |       | GET|HEAD   | admin/article/{article}/edit  | article.edit    | App\Http\Controllers\admin\articleController@edit    | web,admin_login      |
//-----
//
    // post admin/article 添加文章提交
    public function store(Request $request)
    {
        dd($request->all());
    }
//-------------------------------------------------------------------------------------
    // get admin/article 全部文章列表
    public function index()
    {
        echo 'yan';
    }
//-------------------------------------------------------------------------------------
    // get admin/article/create 添加文章
    public function create()
    {
        $article = (new Category())->tree();

        return view('admin.article.add', compact('article'));
    }
//-------------------------------------------------------------------------------------
    // DELETE admin/article/{article}  {參數} 刪除單個文章 {article}此參數無法透過 Request $request
    // 因此 admin/article/11111 把參數帶入 html name='art_id' value=11111
    public function destroy(Request $request, $art_id)
    {

    }
//-------------------------------------------------------------------------------------
    // put admin/article/{article} 更新文章 ,{article}此參數無法透過 Request $request
    // 因此 admin/article/11111 把參數帶入 html name='art_id' value=11111
    public function update(Request $request, $art_id)
    {

    }
//-------------------------------------------------------------------------------------
    // get admin/article/{article} 顯示單個文章訊息
    public function show()
    {

    }
//-------------------------------------------------------------------------------------
    // get admin/article/{article}/edit 編輯文章
    public function edit($art_id)
    {

    }
//-------------------------------------------------------------------------------------
    //----資源路由 結束
//-------------------------------------------------------------------------------------
}
