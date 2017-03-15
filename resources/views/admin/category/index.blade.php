@extends('layouts.admin')
@section('admin-content')
    <!--麵包屑導航 開始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首頁</a> &raquo; 全部分類
    </div>
    <!--麵包屑導航 結束-->

    {{--<!--結果頁快捷搜索框 開始-->--}}
    {{--<div class="search_wrap">--}}
    {{--<form action="" method="post">--}}
    {{--<table class="search_tab">--}}
    {{--<tr>--}}
    {{--<th width="120">選擇分類:</th>--}}
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
            <!--快捷導航 開始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>新增文章</a>
                    <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                    <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
                </div>
            </div>
            <!--快捷導航 結束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" style="width: 10%">排序</th>
                        <th class="tc" style="width: 10%">ID</th>
                        <th>分類名稱</th>
                        <th>標題</th>
                        <th>查看次數</th>

                        <th>操作</th>
                    </tr>
                    @foreach($data as $value)
                        <tr>
                            <td class="tc" style="width: 5%">
                                <input type="text"
                                       pattern="[0-9]{2}"
                                       name="ord[]"
                                       min="0"
                                       placeholder="請輸入數字"
                                       style="width: 100%"
                                       onchange="changorder($(this).val(),{{$value->cate_id}})" ;
                                >
                            <td class="tc" style="width: 5%" name="cate_id[]">{{$value->cate_id}}</td>
                            <td>
                                <a href="#">{{$value->_cate_name}}</a>
                            </td>
                            <td>{{$value['cate_title']}}</td>
                            <td>{{$value->cate_view}}</td>
                            <td>
                                <a href="{{url('admin/category/'.$value->cate_id.'/edit')}}">修改</a>
                                <a href="#">刪除</a>
                            </td>
                        </tr>
                    @endforeach
                    {{--<!-- 怎麼把值傳到JS -->--}}
                    {{--@foreach($data as $value)--}}
                    {{--<tr>--}}
                    {{--<td class="tc" style="width: 5%">--}}
                    {{--<input type="number" name="ord[]"  min="0" value="0" style="width: 100%">--}}
                    {{--<td class="tc" style="width: 5%" name="cate_id[]">{{$value->cate_id}}</td>--}}
                    {{--<td>--}}
                    {{--<a href="#">{{$value->_cate_name}}</a>--}}
                    {{--</td>--}}
                    {{--<td>{{$value['cate_title']}}</td>--}}
                    {{--<td>{{$value->cate_view}}</td>--}}
                    {{--<td>--}}
                    {{--<a href="#">修改</a>--}}
                    {{--<a href="#">刪除</a>--}}
                    {{--</td>--}}
                    {{--</tr>--}}
                    {{--@endforeach--}}
                    {{--<!-- 怎麼把值傳到JS -->--}}
                </table>


                <div class="page_nav">
                    <div>
                        <a class="first" href="/wysls/index.php/Admin/Tag/index/p/1.html">第一頁</a>
                        <a class="prev" href="/wysls/index.php/Admin/Tag/index/p/7.html">上一頁</a>
                        <a class="num" href="/wysls/index.php/Admin/Tag/index/p/6.html">6</a>
                        <a class="num" href="/wysls/index.php/Admin/Tag/index/p/7.html">7</a>
                        <span class="current">8</span>
                        <a class="num" href="/wysls/index.php/Admin/Tag/index/p/9.html">9</a>
                        <a class="num" href="/wysls/index.php/Admin/Tag/index/p/10.html">10</a>
                        <a class="next" href="/wysls/index.php/Admin/Tag/index/p/9.html">下一頁</a>
                        <a class="end" href="/wysls/index.php/Admin/Tag/index/p/11.html">最後一頁</a>
                        <span class="rows">11 條記錄</span>
                    </div>
                </div>


                <div class="page_list">
                    <ul>
                        <li class="disabled"><a href="#">&laquo;</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
    <!--搜索結果頁面 列表 結束-->
    {{--第三方JS layer http://layer.layui.com--}}
    <script>
        function changorder(cate_order, cate_id) {
            $.post(
                '{{url('admin/changorder')}}',
                {
                    'cate_order': cate_order,
                    'cate_id': cate_id,
                    '_token': '{{csrf_token()}}'
                },
                function (data) {
                    if (data.status == 0) {
                        layer.msg(data.message, {icon: 6});
                        {{--第三方JS layer http://layer.layui.com--}}
                        window.location.reload("{{url('admin/category')}}");// 網頁更新

                    } else {
                        layer.msg(data.message, {icon: 5});
                        {{--第三方JS layer http://layer.layui.com--}}

                    }

                }
            );
        }
    </script>
    {{--<script>--}}

    {{--$(document).ready(function () {--}}
    {{--$("input[name|='ord[]']").keyup(function () {--}}
    {{--$.post(--}}
    {{--'{{url('admin/changorder')}}',--}}
    {{--{--}}
    {{--'changorder':$(this).val(),--}}
    {{--'cate_id':$("[name|'cate_id[]']").val(),--}}
    {{--'_token':'{{csrf_token()}}'--}}
    {{--},--}}
    {{--function (data) {--}}
    {{--}--}}
    {{--);--}}
    {{--});--}}
    {{--});--}}
    {{--</script>--}}
@endsection