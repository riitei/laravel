<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class IndexController extends CommonController
{
    public function index()
    {
        return view('admin.index');
    }

    public function info()
    {
        return view('admin.info');
    }

    // 更改超級管理員密碼 使用框架 驗證規則
    public function password(Request $request)
    {
        if ($data = $request->except('_token')) {
            // 驗證規則
            // http://laravelacademy.org/post/6768.html
            // confirmed
            // 验证字段必须有一个匹配字段 foo_confirmation，例如，如果验证字段是 password，必须输入一个与之匹配的password_confirmation 字段。
            $rules = [
                'new_password' => 'required|min:2|confirmed', // input name='new_password' 不為空 | (or) 大於等於２
            ];
            // 自定義錯誤訊息
            $message = [
                'new_password.required' => '新密碼不為空！',// 格式 html標籤(input name) . 規則(required) => 制定錯誤訊息
                'new_password.min' => '新密碼大於2！',
                'new_password.confirmed' => '新密碼和確認密碼不一致！',
            ];
            $validator = \Validator::make($data, $rules, $message);// 輸入值,驗證規則,自訂錯誤訊息
            if ($validator->passes()) {
//                echo '驗證 成功';
                $user = User::select('user_password')->where('user_name', 'admin')->first();
                $password = Crypt::decrypt($user['user_password']);

                if ($request->input('old_password') === $password) {
                    User::where('user_name', 'admin')->
                    update(['user_password' => Crypt::encrypt($request->input('new_password'))]);
//                    $user->user_password =  Crypt::encrypt($request->input('new_password'));
//                    $user->update();
                    return redirect('admin/pass')->with('errors', '密碼更新成功');
                } else {
                    return back()->with('errors', '原密碼錯誤！');
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

        } else {
            return view('admin.pass');

        }
    }
}
