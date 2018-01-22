<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        if ($articleData = $request->except('_token')) {
            //
//            // 驗證規則
//            // http://laravelacademy.org/post/6768.html
//            // confirmed
//            // 验证字段必须有一个匹配字段 foo_confirmation，例如，如果验证字段是 password，必须输入一个与之匹配的password_confirmation 字段。
            $rules = [
                'art_title' => 'required', // input name='art_title' 不為空
                'art_content' => 'required', // input name='art_content' 不為空

            ];
            // 自定義錯誤訊息
            $message = [
                'art_title.required' => '分類 文章標題 必須填寫！',// 格式 html標籤(input name) . 規則(required) => 制定錯誤訊息
                'art_content.required' => '分類 文章內容 必須填寫！',// 格式 html標籤(input name) . 規則(required) => 制定錯誤訊息

            ];
            $validator = Validator::make($articleData, $rules, $message);// 輸入值,驗證規則,自訂錯誤訊息
            if ($validator->passes()) {
//                echo '驗證 成功';
                $result = Article::create($articleData);
                if ($result) {
                    return redirect('admin/article');
                } else {
                    return back()->with('errors', '添加文章失敗');
                }
            } else {
//               dd( $validator->errors()->all());
//                echo '驗證 失敗';
                return back()->withErrors($validator->errors());
                // 检查请求是够通过验证后，可以使用 withErrors 方法将错误数据存放到一次性 Session，使用该方法时，
                // $errors 变量重定向后自动在视图间共享，从而允许你轻松将其显示给用户，
                // withErrors 方法接收一个验证器、或者一个 MessageBag ，
                // 又或者一个 PHP 数组。
//
            }
        }
    }

//-------------------------------------------------------------------------------------
    // get admin/article 全部文章列表
    public function index()
    {
        $article = Article::orderBy('art_time', 'desc')->paginate(5);
        // 分頁 paginate
        // http://laravelacademy.org/post/6960.html
        // dd($data->links());
        return view('admin.article.index', compact('article'));
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
        $result = Article::where('art_id', $art_id)->delete();
        //
        if ($result) {
            $data = [
                'status' => 0,
                'msg' => '文章刪除_成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'msg' => '文章刪除_失敗'
            ];

        }
        return $data;
    }

//-------------------------------------------------------------------------------------
    // put admin/article/{article} 更新文章 ,{article}此參數無法透過 Request $request
    // 因此 admin/article/11111 把參數帶入 html name='art_id' value=11111
    public function update(Request $request, $art_id)
    {
        $article = $request->except('_method', '_token');
        $result = Article::where('art_id', $art_id)
            ->update($article);// 可以直接給 array
        //
        if ($result) {
            return redirect('admin/article');
        } else {
            return back()->with('errors', '文章更新失敗');
        }
    }

//-------------------------------------------------------------------------------------
    // get admin/article/{article} 顯示單個文章訊息
    public function show()
    {

    }

//-------------------------------------------------------------------------------------
    // get admin/article/{article}/edit 編輯文章
    public function edit(Request $request, $art_id)
    {
        $category = (new Category())->tree();
        $article = Article::find($art_id); //利用pk去找資料
        return view('admin.article.edit', compact('category', 'article'));
    }

//-------------------------------------------------------------------------------------
    //----資源路由 結束
//-------------------------------------------------------------------------------------
}
