@extends('layouts.admin')
@section('admin-content')
    <!--麵包屑導航 開始-->

        <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
    <a href="{{url('admin/info')}}">首頁</a> &raquo; 設定檔 管理
    <!--麵包屑導航 結束-->

    {{--<!--結果頁快捷搜索框 開始-->--}}
    {{--<div class="search_wrap">--}}
    {{--<form action="" method="post">--}}
    {{--<table class="search_tab">--}}
    {{--<tr>--}}
    {{--<th width="120">選擇設定檔:</th>--}}
    {{--<td>--}}
    {{--<select onchange="location.href=this.value;">--}}
    {{--<option value="">全部</option>--}}
    {{--<option value="http://www.baidu.com">百度</option>--}}
    {{--<option value="http://www.sina.com">新浪</option>--}}
    {{--</select>--}}
    {{--</td>--}}
    {{--<th width="70">關鍵字:</th>--}}
    {{--<td><input type="text" name="keywords" placeholder="關鍵字"></td>--}}
    {{--<td><input type="submit" name="sub" value="查詢"></td>--}}
    {{--</tr>--}}
    {{--</table>--}}
    {{--</form>--}}
    {{--</div>--}}
    {{--<!--結果頁快捷搜索框 結束-->--}}

    <!--搜索結果頁面 列表 開始-->



    <h3>設定檔列表</h3>
            <!--快捷導航 開始-->


    <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>新增設定檔</a>
                    <a href="{{url('admin/config')}}"><i class="fa fa-recycle"></i>全部設定檔</a>
            <!--快捷導航 結束-->



    <table class="list_tab">
                    <tr>
                        <th class="tc" style="width: 8%">排序</th>
                        <th class="tc" style="width: 10%">ID</th>
                        <th>設定檔標題</th>
                        <th>設定檔名稱</th>
                        <th>內容</th>

                        <th>操作</th>
                    </tr>
                    <form action="{{url('admin/config/changeContent')}}" method="post">
                        {{csrf_field()}}
                        @foreach($config as $value)
                            <input type="hidden" name="conf_id[]" value="{{$value->conf_id}}">
                            <tr>
                                <td class="tc" style="width: 5%">
                                    <input type="text"
                                           {{--pattern="[0-9]{2}"--}}
                                           min="0"
                                           {{--placeholder="請輸入數字"--}}
                                           style="width: 50%"
                                           onchange="changorder($(this).val(),{{$value->conf_id}})"
                                           value="{{$value->conf_order}}"
                                    >
                                <td class="tc" style="width: 5%">{{$value->conf_id}}
                                </td>

                                <td>
                                    <a href="#">{{$value->conf_title}}</a>
                                </td>
                                <td>{{$value->conf_name}}</td>
                                <td>{!!$value->conf_html !!}</td>
                                <td>
                                    <a href="{{url('admin/config/'.$value->conf_id.'/edit')}}">修改</a>
                                    <a href="javascript:" onclick="dellink({{$value->conf_id}})">刪除</a>
                                    {{--javascript:是表示在触发<a>默认动作时,执行一段JavaScript代码,
                                    而 javascript:; 表示什么都不执行,这样点击<a>时就没有任何反应.--}}

                                </td>
                            </tr>
                    @endforeach

                </table>
                <div class="btn-group">
                    <br>
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </div>

    </form>
    <!--搜索結果頁面 列表 結束-->
    {{--第三方JS layer http://layer.layui.com--}}
    <script>
        // 更新
        function changorder(conf_order, conf_id) {
            $.post(
                '{{url('admin/config/changorder')}}',
                {
                    'conf_order': conf_order,
                    'conf_id': conf_id,
                    '_token': '{{csrf_token()}}'
                },
                function (data) {
                    if (data.status == 0) {
                        layer.msg(data.message, {icon: 6});
                        {{--第三方JS layer http://layer.layui.com--}}

                        setTimeout(function () {
                            history.go(0);
                        }, 500);

                    } else {
                        layer.msg(data.message, {icon: 5});
                        {{--第三方JS layer http://layer.layui.com--}}
                        setTimeout(function () {
                            history.go(0);
                        }, 500);
                    }

                }
            );
        }
        // 刪除 http://laravelacademy.org/post/6732.html
        {{--
        HTML 表单不支持 PUT、PATCH 或者 DELETE 请求方法，
        因此，当定义 PUT、PATCH 或 DELETE 路由时，
        需要添加一个隐藏的 _method 字段到表单中，其值被用作该表单的 HTTP 请求方法：
        --}}

        {{--<form action="/foo/bar" method="POST">--}}
        {{--<input type="hidden" name="_method" value="PUT">--}}
        {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
        {{--</form>--}}
        {{--还可以使用辅助函数 method_field 来实现这一目的：--}}

        {{--{{ method_field('PUT') }}--}}

        function dellink(conf_id) {
            layer.confirm('您確定要刪除這個設定檔嗎？', {
                btn: ['確定', '取消'] //按钮
            }, function () {
                // DELETE admin/config/{config}  {參數} 刪除單個設定檔

                $.post("{{url('admin/config/')}}" + '/' + conf_id, {
                    '_method': 'delete',  // 資源路由 執行 刪除必須添加
                    '_token': "{{csrf_token()}}"
                }, function (data) {
                    if (data.status == 0) {
                        // location.href = location.href;
                        window.location.reload("{{url('admin/config')}}");// 網頁更新
                        layer.msg(data.msg, {icon: 6});
                    } else {
                        layer.msg(data.msg, {icon: 5});
                    }
                });
//            layer.msg('的确很重要', {icon: 1});
            });
        }
    </script>
    {{--<script>--}}

    {{--$(document).ready(function () {--}}
    {{--$("input[name|='ord[]']").keyup(function () {--}}
    {{--$.post(--}}
    {{--'{{url('admin/changorder')}}',--}}
    {{--{--}}
    {{--'changorder':$(this).val(),--}}
    {{--'conf_id':$("[name|'conf_id[]']").val(),--}}
    {{--'_token':'{{csrf_token()}}'--}}
    {{--},--}}
    {{--function (data) {--}}
    {{--}--}}
    {{--);--}}
    {{--});--}}
    {{--});--}}
    {{--</script>--}}
@endsection