<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Model\Links;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LinksController extends Controller
{
    //----資源路由 開始
//
// php artisan route:list
// |Domain | Method     | URI                       | Name          | Action                                             | Middleware           |
// |       | POST       | admin/links               | links.store   | App\Http\Controllers\admin\linksController@store   | web,admin_login      |
// |       | GET|HEAD   | admin/links               | links.index   | App\Http\Controllers\admin\linksController@index   | web,admin_login      |
// |       | GET|HEAD   | admin/links/create        | links.create  | App\Http\Controllers\admin\linksController@create  | web,admin_login      |
// |       | DELETE     | admin/links/{links}       | links.        | App\Http\Controllers\admin\linksController@destroy | web,admin_login      |
// |       | PUT|PATCH  | admin/links/{links}       | links.update  | App\Http\Controllers\admin\linksController@update  | web,admin_login      |
// |       | GET|HEAD   | admin/links/{links}       | links.show    | App\Http\Controllers\admin\linksController@show    | web,admin_login      |
// |       | GET|HEAD   | admin/links/{links}/edit  | links.edit    | App\Http\Controllers\admin\linksController@edit    | web,admin_login      |
//-----
//
    // post admin/links 添加超連結提交
    public function store(Request $request)
    {

        if ($linksData = $request->except('_token')) {
//
//            // 驗證規則
//            // http://laravelacademy.org/post/6768.html
//            // confirmed
//            // 验证字段必须有一个匹配字段 foo_confirmation，例如，如果验证字段是 password，必须输入一个与之匹配的password_confirmation 字段。
            $rules = [
                'link_name' => 'required', // input name='link_title' 不為空
                'link_url' => 'required', // input name='link_content' 不為空

            ];
            // 自定義錯誤訊息
            $message = [
                'link_name.required' => '分類 超連結標題 必須填寫！',// 格式 html標籤(input name) . 規則(required) => 制定錯誤訊息
                'link_url.required' => '分類 超連結內容 必須填寫！',// 格式 html標籤(input name) . 規則(required) => 制定錯誤訊息

            ];
            $validator = Validator::make($linksData, $rules, $message);// 輸入值,驗證規則,自訂錯誤訊息
            if ($validator->passes()) {
//                echo '驗證 成功';
                $result = Links::create($linksData);
                if ($result) {
                    return redirect('admin/links');
                } else {
                    return back()->with('errors', '添加超連結失敗');
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
    // get admin/links 全部超連結列表
    public function index()
    {
//        $links = Links::orderBy('link_time', 'desc')->paginate(5);
//        // 分頁 paginate
//        // http://laravelacademy.org/post/6960.html
//        // dd($data->links());
        $links = Links::orderBy('link_order', 'asc')->get();
        return view('admin.links.index', compact('links'));
    }

//-------------------------------------------------------------------------------------
    // get admin/links/create 添加超連結
    public function create()
    {

        return view('admin.links.add');
    }

//-------------------------------------------------------------------------------------
    // DELETE admin/links/{links}  {參數} 刪除單個超連結 {links}此參數無法透過 Request $request
    // 因此 admin/links/11111 把參數帶入 html name='link_id' value=11111
    public function destroy(Request $request, $link_id)
    {
        $result = Links::where('link_id', $link_id)->delete();
        //
        if ($result) {
            $data = [
                'status' => 0,
                'msg' => '超連結刪除_成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'msg' => '超連結刪除_失敗'
            ];

        }
        return $data;
    }

//-------------------------------------------------------------------------------------
    // put admin/links/{links} 更新超連結 ,{links}此參數無法透過 Request $request
    // 因此 admin/links/11111 把參數帶入 html name='link_id' value=11111
    public function update(Request $request, $link_id)
    {
        $links = $request->except('_method', '_token');
        $result = Links::where('link_id', $link_id)
            ->update($links);// 可以直接給 array
        //
        if ($result) {
            return redirect('admin/links');
        } else {
            return back()->with('errors', '超連結更新失敗');
        }
    }

//-------------------------------------------------------------------------------------
    // get admin/links/{links} 顯示單個超連結訊息
    public function show()
    {

    }

//-------------------------------------------------------------------------------------
    // get admin/links/{links}/edit 編輯超連結
    public function edit(Request $request, $link_id)
    {
        $links = Links::find($link_id); //利用pk去找資料
        return view('admin.links.edit', compact('links'));
    }

//-------------------------------------------------------------------------------------
    //----資源路由 結束
//-------------------------------------------------------------------------------------
    public function changorder(Request $request)
    {

        $links_result = Links::where('link_id', $request->input('link_id'))
            ->update($request->except('_token'));

        if ($links_result) {
            $data = [
                'status' => 0,
                'message' => '超連結 排序更新_成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'message' => '超連結 排序更新_失敗'
            ];
        }
        return $data;
    }
}
