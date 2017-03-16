@extends('layouts.admin')
@section('admin-content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首頁</a> &raquo; 編輯文章分類
    </div>
    <!--面包屑导航 结束-->

    <!--結果集標題與導航組件 開始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>分類管理</h3>
            @if(count($errors)>0)
                <div class="mark" style="color: red">
                    @if(is_object($errors))
                        @foreach($errors->all() as $value)
                            {{$value}} <br>
                        @endforeach
                    @else
                        {{$errors}}
                    @endif
                </div>
            @endif
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>新增分類</a>
                <a href="{{url('admin/category')}}"><i class="fa fa-recycle"></i>全部分類</a>
            </div>
        </div>
    </div>
    <!--結果集標題與導航組件 結束-->

    <div class="result_wrap">
        <form action="{{url('admin/category/'.$category->cate_id)}}" method="post">
            {{--6、表单方法伪造--}}
            {{--HTML 表单不支持 PUT、PATCH 或者 DELETE 请求方法，
            因此，当定义 PUT、PATCH 或 DELETE 路由时，需要添加一个隐藏的 _method 字段到表单中，
            其值被用作该表单的 HTTP 请求方法：--}}

            {{--<form action="/foo/bar" method="POST">--}}
            {{--<input type="hidden" name="_method" value="PUT">--}}
            {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
            {{--</form>--}}
            {{--还可以使用辅助函数 method_field 来实现这一目的：--}}

            {{--{{ method_field('PUT') }}--}}
            {{----}}

            {{method_field('put')}}
            {{csrf_field()}}

            <table class="add_tab">
                <tbody>
                <tr>
                    <th width="120"><i class="require">*</i>父級分類：</th>
                    <td>
                        <select name="cate_pid">
                            <option value="0">==頂級分類==</option>
                            @foreach($data as $value)
                                <option value="{{$value->cate_id}}"
                                        @if($value->cate_id==$category->cate_pid)selected
                                        @endif>
                                    {{$value->cate_name}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>分類名稱：</th>
                    <td>
                        <input type="text" name="cate_name" value="{{$category->cate_name}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>分類名稱必須填寫</span>
                    </td>
                </tr>
                <tr>
                    <th>分類標題：</th>
                    <td>
                        <input type="text" class="lg" name="cate_title" value="{{$category->cate_title}}">
                        <p>標題可以寫30字</p>
                    </td>
                </tr>
                <tr>
                    <th>關鍵詞：</th>
                    <td>
                        <textarea name="cate_keywords">{{$category->cate_keywords}}</textarea>
                    </td>
                </tr>
                <tr>
                    <th>描述：</th>
                    <td>
                        <textarea name="cate_description">{{$category->cate_description}}</textarea>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>排序：</th>
                    <td>
                        <input type="text" name="cate_order" value="{{$category->cate_order}}">
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>

@endsection