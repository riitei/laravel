@extends('layouts.home')

@php $config = \App\Http\Model\Config::where('conf_name', 'web_title')->first();
@endphp
@section('home-title-info')
    <title>{{$article->art_title}} - ({{$config->conf_title}}</title>
    <meta name="keywords" content="{{$article->art_tab}}"/>
    <meta name="description" content="{{$article-> art_description}}"/>
@endsection


@section('home-content')


    <a href="{{url('/')}}">網站首頁</a>
    <a href="{{url('cate/'.$article->cate_id)}}">{{$article->cate_name}}</a>

        <h1 class="c_titile">{{$article->art_title}}</h1>
        
    <span>發佈時間：{{$article->art_time}}</span>
    <span>編輯：{{$article->art_edit}}</span>
    <span>查看次數：{{$article->art_view}} </span>

        
    <div style="width:1000px;">    
        {!!  $article->art_content !!}
    </div>
        
    <div>
            <p><span>關鍵字詞</span>{{$article->art_tag}}</p>    
    </div>
       
        
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
        
        
          <h2>相關文章</h2>
          
    @foreach($article_data as $value)            
    <li>
        <a href="{{url('art/'.$value->art_id)}}" title="{{$value->art_title}}">{{$value->art_title}}</a>
    </li>
            
    @endforeach

      
          @parent

      @endsection