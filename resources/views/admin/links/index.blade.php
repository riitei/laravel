@extends('layouts.admin')
@section('admin-content')
    <!--麵包屑導航 開始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首頁</a> &raquo; 超連結 管理
    </div>
    <!--麵包屑導航 結束-->

    {{--<!--結果頁快捷搜索框 開始-->--}}
    {{--<div class="search_wrap">--}}
    {{--<form action="" method="post">--}}
    {{--<table class="search_tab">--}}
    {{--<tr>--}}
    {{--<th width="120">選擇超連結:</th>--}}
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
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_title">
                <h3>超連結列表</h3>
            </div>
            <!--快捷導航 開始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/links/create')}}"><i class="fa fa-plus"></i>新增超連結</a>
                    <a href="{{url('admin/links')}}"><i class="fa fa-recycle"></i>全部超連結</a>
                </div>
            </div>
            <!--快捷導航 結束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" style="width: 8%">排序</th>
                        <th class="tc" style="width: 10%">ID</th>
                        <th>超連結名稱</th>
                        <th>超連結標題</th>
                        <th>超連結地址</th>

                        <th>操作</th>
                    </tr>
                    @foreach($links as $value)
                        <tr>
                            <td class="tc" style="width: 5%">
                                <input type="text"
                                       pattern="[0-9]{2}"
                                       name="ord[]"
                                       min="0"
                                       {{--placeholder="請輸入數字"--}}
                                       style="width: 50%"
                                       onchange="changorder($(this).val(),{{$value->link_id}})"
                                       value="{{$value->link_order}}"
                                >
                            <td class="tc" style="width: 5%" name="link_id[]">{{$value->link_id}}</td>
                            <td>
                                <a href="#">{{$value->link_name}}</a>
                            </td>
                            <td>{{$value->link_title}}</td>
                            <td>{{$value->link_url}}</td>
                            <td>
                                <a href="{{url('admin/links/'.$value->link_id.'/edit')}}">修改</a>
                                <a href="javascript:" onclick="dellink({{$value->link_id}})">刪除</a>
                                {{--javascript:是表示在触发<a>默认动作时,执行一段JavaScript代码,
                                而 javascript:; 表示什么都不执行,这样点击<a>时就没有任何反应.--}}

                            </td>
                        </tr>
                    @endforeach
                    {{--<!-- 怎麼把值傳到JS -->--}}
                    {{--@foreach($data as $value)--}}
                    {{--<tr>--}}
                    {{--<td class="tc" style="width: 5%">--}}
                    {{--<input type="number" name="ord[]"  min="0" value="0" style="width: 100%">--}}
                    {{--<td class="tc" style="width: 5%" name="link_id[]">{{$value->link_id}}</td>--}}
                    {{--<td>--}}
                    {{--<a href="#">{{$value->_link_name}}</a>--}}
                    {{--</td>--}}
                    {{--<td>{{$value['link_title']}}</td>--}}
                    {{--<td>{{$value->link_view}}</td>--}}
                    {{--<td>--}}
                    {{--<a href="#">修改</a>--}}
                    {{--<a href="#">刪除</a>--}}
                    {{--</td>--}}
                    {{--</tr>--}}
                    {{--@endforeach--}}
                    {{--<!-- 怎麼把值傳到JS -->--}}
                </table>
            </div>
        </div>
    </form>
    <!--搜索結果頁面 列表 結束-->
    {{--第三方JS layer http://layer.layui.com--}}
    <script>
        // 更新
        function changorder(link_order, link_id) {
            $.post(
                '{{url('admin/links/changorder')}}',
                {
                    'link_order': link_order,
                    'link_id': link_id,
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

        function dellink(link_id) {
            layer.confirm('您確定要刪除這個超連結嗎？', {
                btn: ['確定', '取消'] //按钮
            }, function () {
                // DELETE admin/links/{links}  {參數} 刪除單個超連結

                $.post("{{url('admin/links/')}}" + link_id, {
                    '_method': 'delete',  // 資源路由 執行 刪除必須添加
                    '_token': "{{csrf_token()}}"
                }, function (data) {
                    if (data.status == 0) {
                        // location.href = location.href;
                        window.location.reload("{{url('admin/links')}}");// 網頁更新
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
    {{--'link_id':$("[name|'link_id[]']").val(),--}}
    {{--'_token':'{{csrf_token()}}'--}}
    {{--},--}}
    {{--function (data) {--}}
    {{--}--}}
    {{--);--}}
    {{--});--}}
    {{--});--}}
    {{--</script>--}}
@endsection