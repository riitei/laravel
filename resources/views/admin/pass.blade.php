@extends('layouts.admin')
@section('admin-content')
    <!--麵包屑導航 開始-->

        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <a href="#">首页</a> &raquo; 修改密码
    </div>
    <!--麵包屑導航 結束-->

    <!--结果集标题与导航组件 开始-->


    <h3>修改密码</h3>

        </div>
        @if(count($errors)>0)
            <div class="mark" style="color: red">
                @if(is_object($errors))
                    @foreach($errors->all() as $value)
                        {{$value}} <br>
                    @endforeach
                @else
                    {{$errors}}
                @endif
            </div>
        @endif
        {{--@if(session('error'))--}}
        {{--<div class="mark" style="color: red">--}}
        {{--{{session('error')}}<br>--}}
        {{--</div>--}}
        {{--@endif--}}
    </div>

    <!--结果集标题与导航组件 结束-->


            <form method="post" action="">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            {{--{{csrf_field()}}//同等於這句話--}}

            <table class="add_tab">
                <tbody>
                <tr>
                    <th width="120"><i class="require">*</i>原密碼：</th>
                    <td>
                        <input type="password" name="old_password"> </i>請輸入原始密碼</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>新密码：</th>
                    <td>
                        <input type="password" name="new_password"> </i>新密碼2位以上</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>確認密碼：</th>
                    <td>
                        <input type="password" name="new_password_confirmation"> </i>再次輸入密碼</span>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
@endsection