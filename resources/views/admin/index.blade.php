@extends('layouts.admin')
@section('admin-content')
    <!--頭部開始 繼承後修改內容-->
    <div id="header">

        後台管理模板
        <a href="{{url('/')}}" class="active" target="_blank">首頁</a>
        <a href="{{url('admin/info')}}" target="main">管理頁</a>
        {{--</div>--}}
        {{--<div style="letter-spacing: 12px ;line-height: 100px ;--}}
        {{--margin-left : 30px;--}}
        <div style="float: right">

            管理員：admin
            <a href="{{url('admin/pass')}}" target="main">修改密碼</a>
            <a href="{{url('admin/quit')}}">退出</a>
        </div> {{--background:darksalmon">--}}


    </div>
    <!--頭部 結束-->
    <!--左側導航 開始-->
    <div id="left_side">
        <ul>
            <li>
                <h3>內容管理</h3>
                <ul>
                    <li><a href="{{url('admin/category/create')}}" target="main">添加分類</a>
                    </li>
                    <li><a href="{{url('admin/category')}}" target="main">分類列表</a>
                    </li>
                    <li><a href="{{url('admin/article/create')}}" target="main">添加文章</a>
                    </li>
                    <li><a href="{{url('admin/article')}}" target="main">文章列表</a>
                    </li>
                </ul>
            </li>
            <li>
                <h3>系統設置</h3>
                <ul style="display: block;">
                    <li><a href="{{url('admin/links')}}" target="main">友情鏈結</a></li>
                    <li><a href="{{url('admin/navs')}}" target="main">自定義導航</a></li>
                    <li><a href="{{url('admin/config')}}" target="main">網站配置</a></li>
                    {{--target="main"配合iframe name 使用--}}
                </ul>
            </li>
        </ul>
    </div>


    <!--左側導航 結束-->

    <!--主體部分 開始-->
    <div id="content">
    @yield('admin-content')<!--引用模板文件，繼承後替換內容-->

        <iframe src="{{url('admin/info')}}"
                name="main"
                frameborder="0"
                scrolling="no"
                id="external-frame"
                onload="setIframeHeight(this)">>
        </iframe>
    </div>
    <!--主體部分 結束-->

    <style type="text/css">

        #header {
            margin: 20px;
            height: 80px;
            /*border:solid 1px #0000FF;*/
        }

        #left_side {
            position: absolute;
            margin: 50px 0px 0px 0px;
            top: 0px;
            left: 0px;
            /*border:solid 1px #0000FF;*/
            width: 170px;
            height: 100%;
        }

        #content {
            margin: 0px 190px 0px 190px;
            /*border:solid 1px #0000FF;*/
            /*width: 1000px;*/
            height: 100%;
        }

    </style>
    <script>
        function setIframeHeight(iframe) {
            if (iframe) {
                var iframeWin = iframe.contentWindow || iframe.contentDocument.parentWindow;
                if (iframeWin.document.body) {
                    iframe.height = iframeWin.document.documentElement.scrollHeight || iframeWin.document.body.scrollHeight;
                }
            }
        }
        window.onload = function () {
            setIframeHeight(document.getElementById('external-frame'));
        };
    </script>
@endsection


