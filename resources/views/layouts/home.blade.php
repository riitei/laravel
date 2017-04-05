<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    @yield('home-title-info')
    <link href="{{asset('resources/views/home/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/index.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/new.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="{{asset('resources/views/home/js/modernizr.js')}}"></script>
    <![endif]-->
</head>
<body>
<header>
    <a href="{{url('/')}}">
        <img src="{{asset('resources/views/home/images/home.jpg')}}">
    </a>

    <nav class="topnav" id="topnav">
        @foreach($navs as $value)
            <a href="{{$value->nav_url}}"><span>{{$value->nav_name_tw}}</span>
                <span class="en">{{$value->nav_name_en}}</span></a>

        @endforeach
    </nav>
</header>

@section('home-content')<!--引用模板文件，繼承後替換內容-->
<h3>
                    <p>最新<span>文章</span></p>
                
</h3>
            
<ul class="rank">
    @foreach($article_new as $value)
        <li>
            <a href="{{url('art/'.$value->art_id)}}" title="{{$value->art_title}}"
               target="_blank">{{$value->art_title}}</a>
        </li>@endforeach  
</ul>
            
<h3 class="ph">
                    <p>點擊<span>排行</span></p>
                
</h3>
            
<ul class="paih">
                     @foreach($article_hot as $value)
        <li><a href="{{url('art/'.$value->art_id)}}" title="{{$value->art_title}}"
               target="_blank">{{$value->art_title}}</a></li>@endforeach
                
</ul>


@show

<footer>
    <p><a href="/">網站統計</a>
    </p>
</footer>
</body>
</html>
