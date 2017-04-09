@extends('layouts.home')
@section('home-title-info')
    <title>{{$cate->cate_name}} 文章列表</title>
    <meta name="keywords" content="{{$cate->cate_cate_keywords}}"/>
    <meta name="description" content="{{$cate->cate_description}}"/>
@endsection

@section('home-content')
    <h1>
        <a href="{{url('/')}}">網站首頁</a> -> {{$cate->cate_name}} -> {{$cate->cate_title}}<br>

        @if($subCate->all())   
        @foreach($subCate as $value)
            <a href="{{url('cate/'.$value->cate_id)}}"> {{$value->cate_title}}</a>
        @endforeach
        @endif
    </h1>
    @foreach($article as $value)
        <h2>{{$value->art_title}}</h2>
        {{$value->art_time}}
        {{$value->art_edit}}
        分類：
        [<a href="{{url('cate/'.$cate->cate_id)}}">{{$cate->cate_name}}</a>]

        <img src="{{url($value->art_thumb)}}" style="width: 200px;height: 100px">
        <p>{{$value->art_description}}</p>
        <a title="{{$value->art_title}}"
           href="{{url('art/'.$value->art_id)}}"
           target="_blank" class="readmore">閱讀全文>> </a>
    @endforeach
    {{$article->links()}}
         

    @parent    {{--調用show--}}
             
                    




@endsection
