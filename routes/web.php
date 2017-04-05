<?php
// 路由参数总是通过花括号进行包裹，这些参数在路由被执行时会被传递到路由的闭包。路由参数不能包含 - 字符，需要的话可以使用 _ 替代。

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//
Route::any('/test', 'TestController@index');
Route::any('upload','TestController@upload');
//-----
/*
 * php artisan make:middleware AdminLogin
 *    App\Http\Kernel 在 $routeMiddleware 註冊
 * 小心格式 [       ,'middleware'=>['web',.....]  ]
 **/
Route::group(['middleware' => ['web']], function () {
    Route::any('/', 'Home\IndexController@index');
    Route::any('/cate/{cate_id}', 'Home\IndexController@cate');
    Route::any('/art/{art_id}', 'Home\IndexController@article');


});
Route::any('admin/check_code', 'admin\LoginController@verificationCode');
Route::any('admin/login', 'admin\LoginController@login'); // 管理者登入 （不能寫在middleware）
// 管理者網頁的集合
Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['web', 'admin_login']], function () {
//    Route::any('login', 'LoginController@login'); laravel v5.4 不能這樣寫
    Route::any('index', 'IndexController@index');
    Route::any('info', 'IndexController@info');
    Route::any('pass', 'IndexController@password');
    Route::any('quit', 'LoginController@quit');
/*
    //-----
    // 使用資源路由
// php artisan route:list
// |Domain  | Method     | URI                             | Name             | Action                                                                 | Middleware           |
// |        | POST       | admin/category                  | category.store   | App\Http\Controllers\admin\CategoryController@store                    | web,admin_login      |
// |        | GET|HEAD   | admin/category                  | category.index   | App\Http\Controllers\admin\CategoryController@index                    | web,admin_login      |
// |        | GET|HEAD   | admin/category/create           | category.create  | App\Http\Controllers\admin\CategoryController@create                   | web,admin_login      |
// |        | DELETE     | admin/category/{category}       | category.destroy | App\Http\Controllers\admin\CategoryController@destroy                  | web,admin_login      |
// |        | PUT|PATCH  | admin/category/{category}       | category.update  | App\Http\Controllers\admin\CategoryController@update                   | web,admin_login      |
// |        | GET|HEAD   | admin/category/{category}       | category.show    | App\Http\Controllers\admin\CategoryController@show                     | web,admin_login      |
// |        | GET|HEAD   | admin/category/{category}/edit  | category.edit    | App\Http\Controllers\admin\CategoryController@edit                     | web,admin_login      |
//-----
*/
    Route::resource('category', 'CategoryController'); // 分類文章 路由資源
    Route::resource('article', 'ArticleController'); // 文章 路由資源
    Route::resource('links', 'LinksController'); // 超連結 路由資源
    Route::resource('navs', 'NavsController'); // 自定義導航 路由資源
    Route::resource('config', 'ConfigController'); // 自定義導航 路由資源
//
    Route::any('changorder', 'CategoryController@changorder');// 文章 排序
    Route::any('links/changorder', 'LinksController@changorder');// 超連結 排序
    Route::any('navs/changorder', 'NavsController@changorder');// 自定義導航 排序
    Route::any('config/changorder', 'ConfigController@changorder');// 設定檔 排序
//
    Route::any('upload', 'CommonController@uploadPhotoFile');// 上傳檔案
    Route::any('config/changeContent', 'ConfigController@changeContent');// 設定檔 提交
    Route::any('configFiles', 'ConfigController@configFile');// 網站配置設定檔案
//
//
});


Route::any('test', 'TestController@testDB');

//-----
//**** 範例程式
//
//**** 路由資源
Route::resource('articles', 'AdminRouteGroup\ArticlesController');
// php artisan route:list
// http://laravel.riitei.com/admin/article

/*
 *| GET|HEAD | admin/article                   | article.index   | App\Http\Controllers\Admin\ArticleController@index   | web|
 *| POST     | admin/article                   | article.store   | App\Http\Controllers\Admin\ArticleController@store   | web|
 *| GET|HEAD | admin/article/create            | article.create  | App\Http\Controllers\Admin\ArticleController@create  | web|
 *| DELETE   | admin/article/{article}         | article.destroy | App\Http\Controllers\Admin\ArticleController@destroy | web|
 *| GET|HEAD | admin/article/{article}         | article.show    | App\Http\Controllers\Admin\ArticleController@show    | web|
 *| PUT|PATCH| admin/article/{article}         | article.update  | App\Http\Controllers\Admin\ArticleController@update  | web|
 *| GET|HEAD | admin/article/{article}/edit    | article.edit    | App\Http\Controllers\Admin\ArticleController@edit    | web|
 **/
//**** 路由資源

//-----
Route::any('admin', 'Admin\IndexController@index');
Route::any('blade', 'TestController\ViewController@blabe'); //blade
Route::any('subViewIndex', 'TestController\ViewController@subViewIndexInclude');// sub view blade index 未切割
Route::any('subViewInclude', 'TestController\ViewController@subViewInclude');// sub view blade // 切割子視窗
Route::any('subViewLayouts', 'TestController\ViewController@subViewLayouts');// sub view blade // 切割子視窗
Route::any('indexDB', 'TestController\IndexController@indexDB');// sub view blade // 切割子視窗
//**** 範例程式

//-----
//**** 中間鍵 middleware
/*
 * php artisan make:middleware AdminLogin
 *    App\Http\Kernel 在 $routeMiddleware 註冊
 * 小心格式 [       ,'middleware'=>['web',.....]  ]
 **/
Route::group(['prefix' => 'admin_middleware', 'namespace' => 'AdminMiddleware', 'middleware' => ['web', 'test.admin.login']], function () {
    Route::get('login', 'IndexController@login');
    Route::get('index', 'IndexController@index');

    //Route::resource('article','ArticleController');
});

//**** 中間鍵 middleware
//-----

//**** 路由資源
Route::resource('admin/articles', 'AdminRouteGroup\ArticlesController');
// php artisan route:list
// http://laravel.riitei.com/admin/article

/*
 *| GET|HEAD | admin/article                   | article.index   | App\Http\Controllers\Admin\ArticleController@index   | web|
 *| POST     | admin/article                   | article.store   | App\Http\Controllers\Admin\ArticleController@store   | web|
 *| GET|HEAD | admin/article/create            | article.create  | App\Http\Controllers\Admin\ArticleController@create  | web|
 *| DELETE   | admin/article/{article}         | article.destroy | App\Http\Controllers\Admin\ArticleController@destroy | web|
 *| GET|HEAD | admin/article/{article}         | article.show    | App\Http\Controllers\Admin\ArticleController@show    | web|
 *| PUT|PATCH| admin/article/{article}         | article.update  | App\Http\Controllers\Admin\ArticleController@update  | web|
 *| GET|HEAD | admin/article/{article}/edit    | article.edit    | App\Http\Controllers\Admin\ArticleController@edit    | web|
 **/
//**** 路由資源


//------
//**** 路由分組
/*
Route::any('admin/login', 'Admin\IndexController@login');
Route::any('admin/index', 'Admin\IndexController@index');
*/
//'prefix'前 => 網址／控制器
//‘namespace’命名空間 => php
Route::group(['prefix' => 'adminRouteGroup', 'namespace' => 'AdminRouteGroup'], function () {
    Route::get('login', 'IndexController@login');
    Route::get('index', 'IndexController@index');
});

//**** 路由分組

//------


//------
//**** 命名路由
Route::get('nameroute01', [
    'as' => 'name', // route('name')
    'uses' => 'Admin\IndexController@index'
]);

Route::get('nameroute02', ['as' => 'profile', function () {
    echo route('profile');// http://laravel.riitei.com/user
    return '命名路由';
}]);

Route::get('nameroute03', 'Admin\IndexController@index')->name('profiles'); // route('profiles')
//**** 命名路由


//------


//****  http://laravelacademy.org/post/6732.html
// 路由参数总是通过花括号进行包裹，这些参数在路由被执行时会被传递到路由的闭包。路由参数不能包含 - 字符，需要的话可以使用 _ 替代。
// ('num/{參數}')
Route::get('num/{id}', function ($id) {
    return 'num_' . $id;
});
//-- 給初始值
Route::get('numbers/{id?}', function ($id = null) {
    return 'number_' . $id;
});
//-- 給初始值
Route::get('posts/{post}/comments/{comment}', function ($postId, $commentId) {
    //
});
//-- {post?} 會報錯，只能最後一個帶參數可以給初始值
Route::get('post/{post?}/comment/{comment?}', function ($postId, $commentId = null) {
    //
});
//-- {post?} 會報錯，只能最後一個帶參數可以給初始值
//
//--  正規表達式
Route::get('user/{name}', function ($name) {
    //
})->where('name', '[A-Za-z]+');

Route::get('user/{id}', function ($id) {
    //
})->where('id', '[0-9]+');

Route::get('user/{id}/{name}', function ($id, $name) {
    //
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
//---
//**