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
                    <a href="#"><i class="fa fa-plus"></i>新增文章</a>
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
                                <a href="#">修改</a>
                                <a href="#">刪除</a>
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
    </style>>
@endsection