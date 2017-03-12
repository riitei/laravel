@extends('layouts.admin')
@section('admin-content')
    <!--麵包屑導航 開始-->
    <!--引用模板文件，繼承後替換內容-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 系统基本信息
    </div>
    <!--麵包屑導航 結束-->

    <!--結果集標題與導航組件 開始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                <a href="#"><i class="fa fa-recycle"></i>批量刪除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->


    <div class="result_wrap">
        <div class="result_title">
            <h3>系統基本訊息</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>操作系統</label><span>{{PHP_OS}}</span>
                </li>
                <li>
                    <label>運行環境</label><span>{{$_SERVER['SERVER_SOFTWARE']}}</span>
                </li>
                <li>
                    <label>版本</label><span>v-1.0</span>
                </li>
                <li>
                    <label>上傳附件限制</label><span>
                        {{get_cfg_var("upload_max_filesize")?get_cfg_var("upload_max_filesize"):"不準許上傳附件" }}</span>
                </li>
                <li>
                    <label>台北時間</label><span>{{date('Y年m月d日 G時i分s秒')}}</span>
                </li>
                <li>
                    <label>服務器域名／IP </label><span>{{$_SERVER['SERVER_NAME']}} [ {{$_SERVER['SERVER_ADDR']}} ]</span>
                </li>
                <li>
                    <label>Host</label><span>{{$_SERVER['SERVER_ADDR']}}</span>
                </li>
            </ul>
        </div>
    </div>


    <div class="result_wrap">
        <div class="result_title">
            <h3>使用帮助</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>官方交流网站：</label><span><a href="#">http://laravel.riitei.com</a></span>
                </li>

            </ul>
        </div>
    </div>
    <!--結果集列表組件 結束-->
@endsection
