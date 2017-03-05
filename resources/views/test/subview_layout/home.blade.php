@extends('test.subview_layout.subview')

{{--  替換內容--}}
@section('content')
    @parent
    {{--在主模板添加內容需要加入@parent--}}
    <div class="middle">替換 內容 home</div>
@endsection