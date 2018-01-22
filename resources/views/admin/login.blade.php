<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    {{--<link rel="stylesheet" href="{{asset('resources/views/admin/style/css/ch-ui.admin.css')}}">--}}
    {{--<link rel="stylesheet" href="{{asset('resources/views/admin/style/font/css/font-awesome.min.css')}}">--}}
</head>
<body style="background:#F3F3F4;">
<div class="login_box">
    <h1>Blog</h1>
    <h2>歡迎使用blog管理平台</h2>
    <div class="form">
        @if(session('msg'))
            <p style="color:red">{{session('msg')}}</p>
            {{--\Illuminate\Support\Facades\Session::get('msg')--}}
        @endif
        <form action="{{url('admin/login')}}" method="post">
            {{csrf_field()}}
            <ul>
                <li>
                    <input type="text" name="user_name" class="text"/>
                    <span><i class="fa fa-user"></i></span>
                </li>
                <li>
                    <input type="password" name="user_password" class="text"/>
                    <span><i class="fa fa-lock"></i></span>
                </li>
                <li>
                    <input type="text" class="code" name="code"/>
                    <span><i class="fa fa-check-square-o"></i></span>
                    <img src="{{url('admin/check_code')}}" alt=""
                         onclick="this.src='{{url('admin/check_code?')}}'+Math.random()">

                </li>
                <li>
                    <input type="submit" value="立即登入"/>
                </li>
            </ul>
        </form>

    </div>
</div>
</body>
</html>