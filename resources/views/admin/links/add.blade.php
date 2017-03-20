@extends('layouts.admin')
@section('admin-content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首頁</a> &raquo; 超鏈結 管理
    </div>
    <!--面包屑导航 结束-->

    <!--結果集標題與導航組件 開始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>添加 超連結</h3>
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
                <a href="{{url('admin/links/create')}}"><i class="fa fa-plus"></i>新增超鏈結</a>
                <a href="{{url('admin/links')}}"><i class="fa fa-recycle"></i>全部超鏈結</a>
            </div>
        </div>
    </div>
    <!--結果集標題與導航組件 結束-->

    <div class="result_wrap">
        <form action="{{url('admin/links')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>超鏈結名稱：</th>
                    <td>
                        <input type="text" name="link_name">
                        <span><i class="fa fa-exclamation-circle yellow"></i>超鏈結名稱必須填寫</span>
                    </td>
                </tr>
                <tr>
                    <th>超鏈結標題：</th>
                    <td>
                        <input type="text" class="lg" name="link_title">
                        <p>標題可以寫30字</p>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>URL：</th>
                    <td>
                        <input type="text" class="lg " name="link_url" value="http://">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>排序：</th>
                    <td>
                        <input type="text" name="link_order" style="width: 50px" value="0">
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