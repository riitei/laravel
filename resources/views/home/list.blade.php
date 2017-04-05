@extends('layouts.home')
@section('home-title-info')
    <title>{{$cate->cate_name}} 文章列表</title>
    <meta name="keywords" content="{{$cate->cate_cate_keywords}}"/>
    <meta name="description" content="{{$cate->cate_description}}"/>
@endsection
@section('home-content')
    <article>
        <h1 class="t_nav"><span>{{$cate->cate_title}}</span>
            <a href="{{url('/')}}" class="n1">網站首頁</a>
            <a href="{{$cate->cate_id}}" class="n2">{{$cate->cate_name}}</a>

        </h1>


        <div class="newblog left">
            @foreach($article as $value)
                <h2>{{$value->art_title}}</h2>
                <p class="dateview">
                    <span>{{$value->art_time}}</span>
                    <span>{{$value->art_edit}}</span>
                    <span>分類：
                [<a href="{{url('cate/'.$cate->cate_id)}}">{{$cate->cate_name}}</a>]
                </span>
                </p>
                <figure><img src="{{url($value->art_thumb)}}"></figure>
                <ul class="nlist">
                    <p>{{$value->art_description}}</p>
                    <a title="{{$value->art_title}}"
                       href="{{url('article/'.$value->art_id)}}"
                       target="_blank" class="readmore">閱讀全文>> </a>
                </ul>
                <div class="line"></div>
            @endforeach

            <div class="page">
                {{$article->links()}}
            </div>
        </div>
        <aside class="right">
                        
            <!-- Baidu Button BEGIN -->
            <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a
                        class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span
                        class="bds_more"></span><a class="shareCount"></a></div>
            <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585"></script>
            <script type="text/javascript" id="bdshell_js"></script>
            <script type="text/javascript">
                document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date() / 3600000)
            </script>
            <!-- Baidu Button END -->
                     @if($subCate->all())   
            <div class="rnav">
                                
                <ul>
                    @foreach($subCate as $key => $value)                  
                    <li class="rnav{{$key+1}}">
                        <a href="{{url('cate/'.$value->cate_id)}}" target="_blank">{{$value->cate_name}}</a>
                    </li>
                    @endforeach
                                                        
                </ul>
                            
            </div>
                        @endif
            <div class="news">
                                
                @parent
                {{--調用show--}}
                            
            </div>

                    
        </aside>
    </article>
@endsection
