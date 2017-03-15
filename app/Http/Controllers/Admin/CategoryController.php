<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
//----資源路由 開始

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
    // post admin/category 添加分類提交
    public function store(Request $request)
    {
        // $request->except('_token');

        if ($data = $request->except('_token')) {

            // 驗證規則
            // http://laravelacademy.org/post/6768.html
            // confirmed
            // 验证字段必须有一个匹配字段 foo_confirmation，例如，如果验证字段是 password，必须输入一个与之匹配的password_confirmation 字段。
            $rules = [
                'cate_name' => 'required', // input name='cate_name' 不為空
            ];
            // 自定義錯誤訊息
            $message = [
                'cate_name.required' => '分類名稱必須填寫！',// 格式 html標籤(input name) . 規則(required) => 制定錯誤訊息
            ];
            $validator = Validator::make($request->all(), $rules, $message);// 輸入值,驗證規則,自訂錯誤訊息
            if ($validator->passes()) {
//                echo '驗證 成功';
                $resule = Category::create($data);
                if ($resule) {
                    return redirect('admin/category');
                } else {
                    return back()->with('errors', '添加失敗');
                }
            } else {
//               dd( $validator->errors()->all());
//                echo '驗證 失敗';
                return back()->withErrors($validator->errors());
                // 检查请求是够通过验证后，可以使用 withErrors 方法将错误数据存放到一次性 Session，使用该方法时，
                // $errors 变量重定向后自动在视图间共享，从而允许你轻松将其显示给用户，
                // withErrors 方法接收一个验证器、或者一个 MessageBag ，
                // 又或者一个 PHP 数组。

            }
        }
    }
//-------------------------------------------------------------------------------------
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
//-------------------------------------------------------------------------------------
    // get admin/category/create 添加分類
    public function create()
    {
        $cate_pid = Category::where('cate_pid', 0)->orderBy('cate_id', 'asc')->get();
        return view('admin.category.add', compact('cate_pid'));
    }
//-------------------------------------------------------------------------------------
    // DELETE admin/category/{category}  {參數} 刪除單個分類
    public function destroy()
    {

    }
//-------------------------------------------------------------------------------------
    // put admin/category/{category} 更新分類
    public function update(Request $request, $cate_id)
    {

        $result = Category::where('cate_id', $cate_id)
            ->update($request->except('_token', '_method'));// 可以直接給 array
        //
        if ($result) {
            return redirect('admin/category');
        } else {
            return back()->with('errors', '分類資料更新失敗');
        }
    }
//-------------------------------------------------------------------------------------
    // get admin/category/{category} 顯示單個分類訊息
    public function show()
    {

    }
//-------------------------------------------------------------------------------------
    // get admin/category/{category}/edit 編輯分類
    public function edit($cate_id)
    {
        $category = Category::find($cate_id);
        $data = Category::where('cate_pid', 0)->get();// 頂級分類
        return view('admin.category.edit', compact('category', 'data'));
    }
//-------------------------------------------------------------------------------------
    //----資源路由 結束
//-------------------------------------------------------------------------------------
    public function changorder(Request $request)
    {
        //$request->input('changorder');
        $category_result = Category::where('cate_id', $request->input('cate_id'))
            ->update(
                ['cate_order' => $request->input('cate_order')
                ]
            );

        if ($category_result) {
            $data = [
                'status' => 0,
                'message' => '分類排序更新_成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'message' => '分類排序更新_失敗'
            ];
        }
        return $data;
    }

}
