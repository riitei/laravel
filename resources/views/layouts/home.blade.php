<!doctype html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<header>
    <div id="height">
        <a href="{{url('/')}}" style=" margin-right  : 300px">
            <img src="{{asset('resources/views/home/images/home.jpg')}}">
        </a>
        @foreach($navs as $value)
            <a href="{{url($value->nav_url)}}"
               style="letter-spacing: 12px ;line-height: 100px ;
               margin-left : 30px;
               background:darksalmon">{{$value->nav_name_tw}}</a>
        @endforeach
    </div>


</header>

{{--vertical-align: text-top 垂直向上--}}
<div style=" float: left ;vertical-align: text-top ">
@section('home-content')<!--引用模板文件，繼承後替換內容-->    
</div>
<div style=" float: right ;vertical-align: text-top ">
                          <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare">
        <a class="bds_tsina"></a>
        <a class="bds_qzone"></a>
        <a class="bds_tqq"></a>
        <a class="bds_renren"></a>

    </div>

    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585"></script>
    <script type="text/javascript" id="bdshell_js"></script>
    <script type="text/javascript">
        document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date() / 3600000)
    </script>
    <br> <br>

    <!-- Baidu Button END -->
    <h2>最新文章</h2>
           
    @foreach($article_new as $value)
        <li>
            <a href="{{url('art/'.$value->art_id)}}" title="{{$value->art_title}}"
               target="_blank">{{$value->art_title}}</a>
        </li>
    @endforeach  

              
    <h2>點擊排行</h2>
                     @foreach($article_hot as $value)
        <li><a href="{{url('art/'.$value->art_id)}}" title="{{$value->art_title}}"
               target="_blank">{{$value->art_title}}</a>
        </li>
    @endforeach   
    @show
</div>


</body>
</html>


{{--<style type="text/css">--}}

{{--.page {--}}
{{--margin: 20px 0 0 0;--}}
{{--text-align: center;--}}
{{--width: 100%;--}}
{{--overflow: hidden;--}}
{{--}--}}

{{--.page ul {--}}
{{--}--}}

{{--.page ul li {--}}
{{--margin-left: 10px;--}}
{{--display: inline-block;--}}
{{--/*去除點*/--}}
{{--margin: 0;--}}
{{--font-size: 20px;--}}
{{--float: left;--}}
{{--}--}}

{{--.page ul li span, .page ul li a {--}}
{{--margin: 0 2px;--}}
{{--height: 26px;--}}
{{--line-height: 26px;--}}
{{--border-radius: 50%;--}}
{{--width: 26px;--}}
{{--text-align: center;--}}
{{--display: inline-block;--}}
{{--}--}}

{{--.page ul li a {--}}
{{--margin: 0 2px;--}}
{{--height: 26px;--}}
{{--line-height: 26px;--}}
{{--border-radius: 50%;--}}
{{--width: 26px;--}}
{{--text-align: center;--}}
{{--display: inline-block;--}}
{{--}--}}

{{--.page ul li.active span, .page ul li a:hover {--}}
{{--background: #333;--}}
{{--color: #FFF;--}}
{{--}--}}

{{--.page ul li.disabled span {--}}
{{--background: #CCC;--}}
{{--color: #FFF;--}}
{{--}--}}

{{--.page ul li a {--}}
{{--color: #F33;--}}
{{--border: #999 1px solid;--}}
{{--}--}}

{{--</style>--}}
