@extends('layouts.admin')
@section('admin-content')
    <!--面包屑导航 开始-->

        <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
    <a href="{{url('admin/info')}}">首頁</a> &raquo; 編輯文章超連結
    <!--面包屑导航 结束-->

    <!--結果集標題與導航組件 開始-->


    <h3>超連結管理</h3>
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


    <a href="{{url('admin/links/create')}}"><i class="fa fa-plus"></i>新增超連結</a>
                <a href="{{url('admin/links')}}"><i class="fa fa-recycle"></i>全部超連結</a>
    <!--結果集標題與導航組件 結束-->


    <form action="{{url('admin/links/'.$links->link_id)}}" method="post">
            {{--6、表单方法伪造--}}
            {{--HTML 表单不支持 PUT、PATCH 或者 DELETE 请求方法，
            因此，当定义 PUT、PATCH 或 DELETE 路由时，需要添加一个隐藏的 _method 字段到表单中，
            其值被用作该表单的 HTTP 请求方法：--}}

            {{--<form action="/foo/bar" method="POST">--}}
            {{--<input type="hidden" name="_method" value="PUT">--}}
            {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
            {{--</form>--}}
            {{--还可以使用辅助函数 method_field 来实现这一目的：--}}

            {{--{{ method_field('PUT') }}--}}
            {{----}}

            {{method_field('put')}}
            {{csrf_field()}}

            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>超連結名稱：</th>
                    <td>
                        <input type="text" name="link_name" value="{{$links->link_name}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>超連結名稱必須填寫</span>
                    </td>
                </tr>
                <tr>
                    <th>超連結標題：</th>
                    <td>
                        <input type="text" class="lg" name="link_title" value="{{$links->link_title}}">
                        <p>標題可以寫30字</p>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>URL：</th>
                    <td>
                        <input name="link_url" value="{{$links->link_url}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>排序：</th>
                    <td>
                        <input type="text" name="link_order" value="{{$links->link_order}}">
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

@endsection