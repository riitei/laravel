<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NavsController extends Controller
{
    //----資源路由 開始
//
// php artisan route:list
// |Domain | Method     | URI                     | Name         | Action                                            | Middleware           |
// |       | POST       | admin/navs              | navs.store   | App\Http\Controllers\admin\navsController@store   | web,admin_login      |
// |       | GET|HEAD   | admin/navs              | navs.index   | App\Http\Controllers\admin\navsController@index   | web,admin_login      |
// |       | GET|HEAD   | admin/navs/create       | navs.create  | App\Http\Controllers\admin\navsController@create  | web,admin_login      |
// |       | DELETE     | admin/navs/{navs}       | navs.        | App\Http\Controllers\admin\navsController@destroy | web,admin_login      |
// |       | PUT|PATCH  | admin/navs/{navs}       | navs.update  | App\Http\Controllers\admin\navsController@update  | web,admin_login      |
// |       | GET|HEAD   | admin/navs/{navs}       | navs.show    | App\Http\Controllers\admin\navsController@show    | web,admin_login      |
// |       | GET|HEAD   | admin/navs/{navs}/edit  | navs.edit    | App\Http\Controllers\admin\navsController@edit    | web,admin_login      |
//-----
//
    // post admin/navs 添加自定義導航提交
    public function store(Request $request)
    {

        if ($navsData = $request->except('_token')) {
//
//            // 驗證規則
//            // http://laravelacademy.org/post/6768.html
//            // confirmed
//            // 验证字段必须有一个匹配字段 foo_confirmation，例如，如果验证字段是 password，必须输入一个与之匹配的password_confirmation 字段。
            $rules = [
                'nav_name_tw' => 'required', // input name='nav_title' 不為空
                'nav_url' => 'required', // input name='nav_content' 不為空

            ];
            // 自定義錯誤訊息
            $message = [
                'nav_name_tw.required' => '分類 自定義導航標題 必須填寫！',// 格式 html標籤(input name) . 規則(required) => 制定錯誤訊息
                'nav_url.required' => '分類 自定義導航內容 必須填寫！',// 格式 html標籤(input name) . 規則(required) => 制定錯誤訊息

            ];
            $validator = Validator::make($navsData, $rules, $message);// 輸入值,驗證規則,自訂錯誤訊息
            if ($validator->passes()) {
//                echo '驗證 成功';
                $result = Navs::create($navsData);
                if ($result) {
                    return redirect('admin/navs');
                } else {
                    return back()->with('errors', '添加自定義導航失敗');
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
    // get admin/navs 全部自定義導航列表
    public function index()
    {
//        $navs = Navs::orderBy('nav_time', 'desc')->paginate(5);
//        // 分頁 paginate
//        // http://laravelacademy.org/post/6960.html
//        // dd($data->navs());
        $navs = Navs::orderBy('nav_order', 'asc')->get();
        return view('admin.navs.index', compact('navs'));
    }

//-------------------------------------------------------------------------------------
    // get admin/navs/create 添加自定義導航
    public function create()
    {

        return view('admin.navs.add');
    }

//-------------------------------------------------------------------------------------
    // DELETE admin/navs/{navs}  {參數} 刪除單個自定義導航 {navs}此參數無法透過 Request $request
    // 因此 admin/navs/11111 把參數帶入 html name='nav_id' value=11111
    public function destroy(Request $request, $nav_id)
    {
        $result = Navs::where('nav_id', $nav_id)->delete();
        //
        if ($result) {
            $data = [
                'status' => 0,
                'msg' => '自定義導航刪除_成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'msg' => '自定義導航刪除_失敗'
            ];

        }
        return $data;
    }

//-------------------------------------------------------------------------------------
    // put admin/navs/{navs} 更新自定義導航 ,{navs}此參數無法透過 Request $request
    // 因此 admin/navs/11111 把參數帶入 html name='nav_id' value=11111
    public function update(Request $request, $nav_id)
    {
        $navs = $request->except('_method', '_token');
        $result = Navs::where('nav_id', $nav_id)
            ->update($navs);// 可以直接給 array
        //
        if ($result) {
            return redirect('admin/navs');
        } else {
            return back()->with('errors', '自定義導航更新失敗');
        }
    }

//-------------------------------------------------------------------------------------
    // get admin/navs/{navs} 顯示單個自定義導航訊息
    public function show()
    {

    }

//-------------------------------------------------------------------------------------
    // get admin/navs/{navs}/edit 編輯自定義導航
    public function edit(Request $request, $nav_id)
    {
        $navs = Navs::find($nav_id); //利用pk去找資料
        return view('admin.navs.edit', compact('navs'));
    }

//-------------------------------------------------------------------------------------
    //----資源路由 結束
//-------------------------------------------------------------------------------------
    public function changorder(Request $request)
    {

        $navs_result = Navs::where('nav_id', $request->input('nav_id'))
            ->update($request->except('_token'));

        if ($navs_result) {
            $data = [
                'status' => 0,
                'message' => '自定義導航 排序更新_成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'message' => '自定義導航 排序更新_失敗'
            ];
        }
        return $data;
    }
}
