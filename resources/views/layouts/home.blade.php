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
    <div id="logo"><a href="{{url('/')}}"></a></div>
    <nav class="topnav" id="topnav">
        @foreach($navs as $value)
            <a href="{{$value->nav_url}}"><span>{{$value->nav_name_tw}}</span>
                <span class="en">{{$value->nav_name_en}}</span></a>

        @endforeach
    </nav>
</header>

@yield('home-content')<!--引用模板文件，繼承後替換內容-->


<footer>
    {{--Design by 后盾网 <a href="http://www.miitbeian.gov.cn/" target="_blank">http://www.houdunwang.com</a> --}}
    <p><a href="/">網站統計</a>
    </p>
</footer>
</body>
</html>
