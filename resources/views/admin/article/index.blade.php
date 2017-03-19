@extends('layouts.admin')
@section('admin-content')
    <!--麵包屑導航 開始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i>歡迎使用登陸網站後台，建站的首選工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首頁</a> &raquo; 文章管理
    </div>
    <!--麵包屑導航 結束-->

    <!--結果頁快捷搜索框 開始-->
    <div class="search_wrap">

    </div>
    <!--結果頁快捷搜索框 結束-->

    <!--搜索結果頁面 列表 開始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷導航 開始-->
            <div class="result_title">
                <h3>文章列表</h3>
            </div>
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
                    <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
                </div>
            </div>
            <!--快捷導航 結束-->
        </div>


        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">ID</th>
                        <th>標題</th>
                        <th>點擊次數</th>
                        <th>編輯</th>
                        <th>發布時間</th>
                        <th>操作</th>
                    </tr>
                    @foreach($article as $value)

                        <tr>

                            <td class="tc">{{$value->art_id}}</td>
                            <td>
                                <a href="#">{{$value->art_title}}</a>
                            </td>
                            <td>{{$value->art_view}}</td>
                            <td>{{$value->art_edit}}</td>
                            <td>{{$value->art_time}}</td>
                            <td>
                                <a href="{{url('admin/article/'.$value -> art_id.'/edit')}}">修改</a>
                                <a href="javascript:" onclick="delArt({{$value->art_id}})">刪除</a>
                                {{--javascript:是表示在触发<a>默认动作时,执行一段JavaScript代码,
                             而 javascript:; 表示什么都不执行,这样点击<a>时就没有任何反应.--}}
                            </td>
                        </tr>
                    @endforeach
                </table>


                {{--使用分頁 http://laravelacademy.org/post/6960.html --}}
                <div class="page_list">
                    <ul>
                        {{$article->links()}}
                    </ul>
                </div>
            </div>
        </div>
    </form>
    <!--搜索結果頁面 列表 結束-->
    {{--複寫 分頁 css 排版格式--}}
    <style>
        .result_content ul li span {
            font-size: 15px;
            padding: 6px 12px;
        }
    </style>
    <script>
        function delArt(art_id) {
            layer.confirm('您確定要刪除這文章嗎？', {
                btn: ['確定', '取消'] //按钮
            }, function () {
                // DELETE admin/category/{category}  {參數} 刪除單個分類

                $.post("{{url('admin/article/')}}/" + art_id, {
                    '_method': 'delete',
                    '_token': "{{csrf_token()}}"
                }, function (data) {
                    if (data.status == 0) {
                        // location.href = location.href;
                        layer.msg(data.msg, {icon: 6});
                        //window.location.reload("{{url('admin/article')}}");// 網頁更新
                        setTimeout(function () {
                            location.href = location.href;
                        }, 2000); // 等待 毫秒 網頁更新
                    } else {
                        layer.msg(data.msg, {icon: 5});
                    }
                });
                //            layer.msg('的确很重要', {icon: 1});
            });

        }

    </script>
@endsection