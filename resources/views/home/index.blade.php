@extends('layouts.home')
@section('home-title-info')
    @php $title =  \App\Http\Model\Config::where('conf_name', 'web_title')->first() @endphp

    <title>
        {{$title->conf_title}}
    </title>

@endsection
@section('home-content')
    <!--頭部開始 繼承後修改內容-->
    {{--<div style="float: left">--}}
    {{--<h2>個人推薦</h2>--}}

    <table>
        <tr>

            @foreach($article_hot as $value)
                <td>
                    <a href="{{url('art/'.$value->art_id)}}" target="_blank">
                        <img src="{{url($value->art_thumb)}} " style="width: 100px; height:50px ">
                        <br>{{$value->art_title}}<br>
                    </a>
                </td>
            @endforeach
        </tr>

    </table>




    {{--<p>文章推薦</p>--}}

    @foreach($article_photo as $value)
        <h2>{{$value->art_title}}</h2>
        <img src="{{url($value->art_thumb)}}" style=" width: 200px; height:100px ">


        {{$value->art_description}}
        <a title="{{$value->art_title}}" href="{{url('art/'.$value->art_id)}}"
           target="_blank" class="readmore">閱讀全文>> </a><br>

        {{$value->art_time}}
        作者：{{$value->art_edit}}


    @endforeach

    顯示分頁結果 =>
    {{--{{    strip_tags($article_photo->links(),"<ul><a>")}}--}}
    {{--<div class="page">--}}
    {{$article_photo->links()}}
    {{--</div>--}}
    @parent  

      
            
    <h2>
        <p>友情連結</p>
        @foreach($article_link as $value)
            <a href="{{$value->link_url}}" target="_blank">{{$value->link_name}}</a><br>
        @endforeach

    </h2>
      
    <!--頭部開始 繼承後修改內容-->
@endsection

