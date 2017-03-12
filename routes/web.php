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
//Route::get('/', function () {
//    return view('welcome');
//});


Route::any('admin/login', 'Admin\LoginController@login');
Route::any('admin/check_code', 'Admin\LoginController@verificationCode');
//
Route::any('admin/info', 'Admin\IndexController@info');

Route::any('test', 'TestController@testDB');


//-----
//**** 範例程式 middleware
Route::any('admin', 'Admin\IndexController@index');
Route::any('blade', 'TestController\ViewController@blabe'); //blade
Route::any('subViewIndex', 'TestController\ViewController@subViewIndexInclude');// sub view blade index 未切割
Route::any('subViewInclude', 'TestController\ViewController@subViewInclude');// sub view blade // 切割子視窗
Route::any('subViewLayouts', 'TestController\ViewController@subViewLayouts');// sub view blade // 切割子視窗
Route::any('/indexDB', 'TestController\IndexController@indexDB');// sub view blade // 切割子視窗
//**** 範例程式 middleware
//-----
//**** 中間鍵 middleware
/*
 * php artisan make:middleware AdminLogin
 *    App\Http\Kernel 在 $routeMiddleware 註冊
 * 小心格式 [       ,'middleware'=>['web',.....]  ]
 **/
Route::group(['prefix' => 'admin_middleware', 'namespace' => 'AdminMiddleware', 'middleware' => ['web', 'admin.login']], function () {
    Route::get('login', 'IndexController@login');
    Route::get('index', 'IndexController@index');

    //Route::resource('article','ArticleController');
});

//**** 中間鍵 middleware
//-----

//**** 路由資源
Route::resource('admin/article', 'AdminRouteGroup\ArticleController');
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