@extends('layouts.admin')
@section('admin-content')
    <!--面包屑导航 开始-->

        <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
    <a href="{{url('admin/info')}}">首頁</a> &raquo; 編輯文章設定檔
    <!--面包屑导航 结束-->

    <!--結果集標題與導航組件 開始-->


    <h3>設定檔管理</h3>
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
                <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>新增設定檔</a>
                <a href="{{url('admin/config')}}"><i class="fa fa-recycle"></i>全部設定檔</a>
    <!--結果集標題與導航組件 結束-->


    <form action="{{url('admin/config/'.$config->conf_id)}}" method="post">
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
                    <th><i class="require">*</i>設定檔標題：</th>
                    <td>
                        <input type="text" name="conf_title" value="{{$config->conf_name}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>設定檔名稱必須填寫</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>設定檔名稱：</th>
                    <td>
                        <input type="text" class="lg" name="conf_name" value="{{$config->conf_title}}">
                        <p>標題可以寫30字</p>
                    </td>
                </tr>
                <tr>
                    <th>類型：</th>
                    <td>
                        <input type="radio" name="field_type" value="input"
                               @if($config->field_type=='input')
                               checked
                                @endif
                        >input
                        <input type="radio" name="field_type" value="textarea"
                               @if($config->field_type=='textarea')
                               checked
                                @endif>textarea
                        <input type="radio" name="field_type" value="radio"
                               @if($config->field_type=='radio')
                               checked
                                @endif>radio
                        <span><i class="fa fa-exclamation-circle yellow">

                            </i>類型:input textarea radio
                        </span>

                    </td>
                </tr>
                <tr class="show_value">
                    <th>類型值：</th>
                    <td>
                        <input type="text" class="lg " name="field_value"><br>
                        <span><i class="fa fa-exclamation-circle yellow">

                            </i>類型值: 只有 radio 的情況下才需要配置 格式 1|開啟,0|關閉
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>排序：</th>
                    <td>
                        <input type="text" name="conf_order" value="{{$config->conf_order}}">
                    </td>
                </tr>
                <tr>
                    <th>說明：</th>
                    <td>
                        <input type="text" name="conf_content" value="{{$config->conf_content}}">
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
    <script>

        $(function () {
            // 標籤['屬性=值']
            $('input[name=field_type]').change(function () {
                if ($(this).val() == 'radio') {
                    $('.show_value').show();
                } else {
                    $('.show_value').hide();// 隐藏
                }
            });
        });
    </script>
@endsection