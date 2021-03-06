@extends('layouts.admin')
@section('admin-content')
    <!--面包屑导航 开始-->

        <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
    <a href="{{url('admin/info')}}">首頁</a> &raquo; 添加文章分類
    <!--面包屑导航 结束-->

    <!--結果集標題與導航組件 開始-->


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


    <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>新增分類</a>
                <a href="{{url('admin/category')}}"><i class="fa fa-recycle"></i>全部分類</a>

    <!--結果集標題與導航組件 結束-->


    <form action="{{url('admin/category')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th width="120"><i class="require">*</i>父級分類：</th>
                    <td>
                        <select name="cate_pid">
                            <option value="0">==頂級分類==</option>
                            @foreach($cate_pid as $value)
                                <option value="{{$value->cate_id}}">{{$value->cate_name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>分類名稱：</th>
                    <td>
                        <input type="text" name="cate_name">
                        <span><i class="fa fa-exclamation-circle yellow"></i>分類名稱必須填寫</span>
                    </td>
                </tr>
                <tr>
                    <th>分類標題：</th>
                    <td>
                        <input type="text" class="lg" name="cate_title">
                        <p>標題可以寫30字</p>
                    </td>
                </tr>
                <tr>
                    <th>關鍵詞：</th>
                    <td>
                        <textarea name="cate_keywords"></textarea>
                    </td>
                </tr>
                <tr>
                    <th>描述：</th>
                    <td>
                        <textarea name="cate_description"></textarea>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>排序：</th>
                    <td>
                        <input type="text" name="cate_order"></input>
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
@endsection