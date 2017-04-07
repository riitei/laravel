@extends('layouts.home')

@php $config = \App\Http\Model\Config::where('conf_name', 'web_title')->first();
@endphp
@section('home-title-info')
    <title>{{$article->art_title}} - ({{$config->conf_title}}</title>
    <meta name="keywords" content="{{$article->art_tab}}"/>
    <meta name="description" content="{{$article-> art_description}}"/>
@endsection


@section('home-content')


    <article class="blogs">
          <h1 class="t_nav">
            {{--<span>您當前的位置：--}}
            {{--<a href="{{url('/')}}">首頁</a>--}}
            {{--<a href="{{url('cate/'.$article->cate_id)}}">{{$article->cate_name}}</a>--}}
            {{--</span>--}}
            <a href="{{url('/')}}" class="n1">網站首頁</a>
            <a href="{{url('cate/'.$article->cate_id)}}" class="n2">{{$article->cate_name}}</a>
        </h1>
          
        <div class="index_about">
                <h2 class="c_titile">{{$article->art_title}}</h2>
                
            <p class="box_c">
                <span class="d_time">發佈時間：{{$article->art_time}}</span>
                <span>編輯：{{$article->art_edit}}</span> <span>查看次數：{{$article->art_view}} </span>
            </p>
                
            <ul class="infos">
                      
                {!!  $article->art_content !!}
            </ul>
                
            <div class="keybq">
                    <p><span>關鍵字詞</span>{{$article->art_tag}}</p>
                    
                    
            </div>
                
            <div class="ad"></div>
                
            <div class="nextinfo">
                <p>上一篇：
                    @if($article['UP'])

                        <a href="{{url('art/'.$article['UP']->art_id)}}">{{$article['UP']->art_title}}</a>
                    @else
                        <span>沒有上一篇</span>
                    @endif
                </p>
                <p>下一篇：
                    @if($article['DN'])
                        <a href="{{url('art/'.$article['DN']->art_id)}}">{{$article['DN']->art_title}}</a>
                    @else
                        <span>沒有下一篇</span>
                    @endif
                </p>
                    
            </div>
                
            <div class="otherlink">
                      <h2>相關文章</h2>
                      
                <ul>
                    @foreach($article_data as $value)            
                    <li>
                        <a href="{{url('art/'.$value->art_id)}}" title="{{$value->art_title}}">{{$value->art_title}}</a>
                    </li>
                            
                    @endforeach
                          
                </ul>
                    
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


                
            <div class="blank"></div>
                
            <div class="news">

                      @parent
                    
            </div>

        </aside>
    </article>
@endsection