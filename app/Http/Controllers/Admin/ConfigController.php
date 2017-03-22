<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConfigController extends CommonController
{
    /*
    //----資源路由 開始
//
// php artisan route:list
// |Domain | Method     | URI                     | Name         | Action                                            | Middleware           |
// |       | POST       | admin/conf              | conf.store   | App\Http\Controllers\admin\confController@store   | web,admin_login      |
// |       | GET|HEAD   | admin/conf              | conf.index   | App\Http\Controllers\admin\confController@index   | web,admin_login      |
// |       | GET|HEAD   | admin/conf/create       | conf.create  | App\Http\Controllers\admin\confController@create  | web,admin_login      |
// |       | DELETE     | admin/conf/{conf}       | conf.        | App\Http\Controllers\admin\confController@destroy | web,admin_login      |
// |       | PUT|PATCH  | admin/conf/{conf}       | conf.update  | App\Http\Controllers\admin\confController@update  | web,admin_login      |
// |       | GET|HEAD   | admin/conf/{conf}       | conf.show    | App\Http\Controllers\admin\confController@show    | web,admin_login      |
// |       | GET|HEAD   | admin/conf/{conf}/edit  | conf.edit    | App\Http\Controllers\admin\confController@edit    | web,admin_login      |
//-----
//
  */
    // post admin/conf 添加設定提交
    public function store(Request $request)
    {

        if ($confData = $request->except('_token')) {
//
//            // 驗證規則
//            // http://laravelacademy.org/post/6768.html
//            // confirmed
//            // 验证字段必须有一个匹配字段 foo_confirmation，例如，如果验证字段是 password，必须输入一个与之匹配的password_confirmation 字段。
            $rules = [
                'conf_name' => 'required', // input name='conf_title' 不為空
                'conf_title' => 'required', // input name='conf_content' 不為空

            ];
            // 自定義錯誤訊息
            $message = [
                'conf_name.required' => '分類 設定標題 必須填寫！',// 格式 html標籤(input name) . 規則(required) => 制定錯誤訊息
                'conf_title.required' => '分類 設定內容 必須填寫！',// 格式 html標籤(input name) . 規則(required) => 制定錯誤訊息

            ];
            $validator = Validator::make($confData, $rules, $message);// 輸入值,驗證規則,自訂錯誤訊息
            if ($validator->passes()) {
//                echo '驗證 成功';
                $result = Config::create($confData);
                if ($result) {
                    return redirect('admin/config');
                } else {
                    return back()->with('errors', '添加設定失敗');
                }
            } else {
//               dd( $validator->errors()->all());
//                echo '驗證 失敗';
                return back()->withErrors($validator->errors());
                // 检查请求是够通过验证后，可以使用 withErrors 方许你轻松将其显示给用户，
                // withErrors 方法接收一个验证器、或者一个 MessageBag ，
                // 又或者一个 PHP 数组。
//
            }
        }
    }

//-------------------------------------------------------------------------------------
    // get admin/conf 全部設定列表
    public function index()
    {
        //  echo $key . "_" .
        $config = Config::orderBy('conf_order', 'asc')->get();
        foreach ($config as $key => $value) {

            switch ($value->field_type) {
                case 'input': // 相同name名稱需要加入array
                    $config[$key]['conf_html'] =
                        '<input type="text" class="lg" name="conf_content[]" value="' . $value->conf_content . '">';
                    break;
                case 'textarea': // 相同name名稱需要加入array
                    $config[$key]['conf_html'] =
                        '<textarea type="text" class="lg" name="conf_content[]">' . $value->conf_content . '</textarea>';
                    break;
                case 'radio': // 相同name名稱需要加入array
                    $firstOrder = explode(',', trim($value->field_value));//1|開啟 , 0|關閉
                    $radio = '';// 用於 字串相加
                    foreach ($firstOrder as $tagvalue) {

                        $secondOrder = explode('|', trim($tagvalue));
                        $checked = $value->conf_content == $secondOrder[0] ? ' &nbsp; checked &nbsp; ' : '';
                        $radio .= '<input type="radio" name="conf_content[]" value="' . $secondOrder[0] . '"
                        ' . $checked . '> ' . $secondOrder[1] . ' &nbsp; ';//&nbsp; html空白

                    }
                    $config[$key]['conf_html'] = $radio;
                    break;
            }
        }
//        echo $config[0]['conf_html'] . '<br>';
//
//        echo $config[1]['conf_html'] . '<br>';
//
//        echo $config[2] ['conf_html'] . '<br>';

        return view('admin.config.index', compact('config'));
    }

//-------------------------------------------------------------------------------------
    // get admin/conf/create 添加設定
    public function create()
    {

        return view('admin.config.add');
    }

//-------------------------------------------------------------------------------------
    // DELETE admin/conf/{conf}  {參數} 刪除單個設定 {conf}此參數無法透過 Request $request
    // 因此 admin/conf/11111 把參數帶入 html name='conf_id' value=11111
    public function destroy(Request $request, $conf_id)
    {
        $result = Config::where('conf_id', $conf_id)->delete();
        //
        if ($result) {
            $data = [
                'status' => 0,
                'msg' => '設定刪除_成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'msg' => '設定刪除_失敗'
            ];

        }
        return $data;
    }

//-------------------------------------------------------------------------------------
    // put admin/conf/{conf} 更新設定 ,{conf}此參數無法透過 Request $request
    // 因此 admin/conf/11111 把參數帶入 html name='conf_id' value=11111
    public function update(Request $request, $conf_id)
    {
        $config = $request->except('_method', '_token');
        $result = Config::where('conf_id', $conf_id)
            ->update($config);// 可以直接給 array
        //
        if ($result) {
            return redirect('admin/config');
        } else {
            return back()->with('errors', '設定更新失敗');
        }
    }

//-------------------------------------------------------------------------------------
    // get admin/conf/{conf} 顯示單個設定訊息
    public function show()
    {

    }

//-------------------------------------------------------------------------------------
    // get admin/conf/{conf}/edit 編輯設定
    public function edit(Request $request, $conf_id)
    {
        $config = Config::find($conf_id); //利用pk去找資料
        return view('admin.config.edit', compact('config'));
    }

//-------------------------------------------------------------------------------------
    //----資源路由 結束
//-------------------------------------------------------------------------------------
    public function changorder(Request $request)
    {

        $conf_result = Config::where('conf_id', $request->input('conf_id'))
            ->update($request->except('_token'));

        if ($conf_result) {
            $data = [
                'status' => 0,
                'message' => '設定 排序更新_成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'message' => '設定 排序更新_失敗'
            ];
        }
        return $data;
    }

    public function changeContent(Request $request)
    {
//        dd($request->all());
        foreach ($request['conf_content'] as $key => $value) {
            $result = Config::where('conf_id', $request['conf_id'][$key])
                ->update(['conf_content' => $request['conf_content'][$key]]);
        }
        if ($result) {
            return redirect('admin/config');
        } else {
            return back()->with('errors', '設定更新失敗');
        }
    }
}
