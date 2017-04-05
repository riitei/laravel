@extends('layouts.home')
@section('home-title-info')
    {{--$title = \App\Http\Model\Config::where('conf_name', 'web_title')->first();--}}
    {{--echo $title->conf_title;--}}
    @php $title =  \App\Http\Model\Config::where('conf_name', 'web_title')->first() @endphp

    <title>
        {{$title->conf_title}}
    </title>

@endsection
@section('home-content')
    <!--頭部開始 繼承後修改內容-->

    <div class="template">
        <div class="box">
            <h3>
                <p><span>個人</span>推薦</p>
            </h3>
            <ul>
                @foreach($article_hot as $value)
                    <li>
                        <a href="{{url('art/'.$value->art_id)}}" target="_blank">
                            <img src="{{url($value->art_thumb)}}">
                        </a>
                        <span>{{$value->art_title}}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <article>
        <h2 class="title_tj">
            <p>文章<span>推薦</span></p>
        </h2>
        <div class="bloglist left">
            @foreach($article_photo as $value)
                <h3>{{$value->art_title}}</h3>
                <figure><img src="{{url($value->art_thumb)}}"></figure>
                <ul>
                    <p>
                        {{$value->art_description}}
                        <a title="{{$value->art_title}}" href="{{url('art/'.$value->art_id)}}"
                           target="_blank" class="readmore">閱讀全文>> </a>
                    </p>
                </ul>
                <p class="dateview">
                    <span> {{$value->art_time}}</span>
                    <span>作者：{{$value->art_edit}}</span>
                    </span>
                </p>
            @endforeach
             
            <div class="page">
                {{$article_photo->links()}}
                {{--显示分页结果--}}
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
            {{--<div class="weather">--}}
            {{--     天氣      --}}
            {{--<iframe width="250" scrolling--}}
            {{--="no" height="60" frameborder="0" allowtransparency="true"--}}
            {{--                    src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe>--}}
            {{--        --}}
            {{--</div>--}}
                    
            <div class="news" style="float: right">
                <h3 class="links">
                            @parent    

                    <p>友情<span>連結</span></p>
                    <ul class="website">
                        @foreach($article_link as $value)
                            <li><a href="{{$value->link_url}}" target="_blank">{{$value->link_name}}</a></li>@endforeach
                    </ul>
                </h3>

            </div>

        </aside>
    </article>
    <!--頭部開始 繼承後修改內容-->

@endsection