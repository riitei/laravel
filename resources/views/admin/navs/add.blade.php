@extends('layouts.admin')
@section('admin-content')
    <!--面包屑导航 开始-->

        <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
    <a href="{{url('admin/info')}}">首頁</a> &raquo; 自定義導航 管理
    </div>
    <!--面包屑导航 结束-->

    <!--結果集標題與導航組件 開始-->


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


                <a href="{{url('admin/navs/create')}}"><i class="fa fa-plus"></i>新增自定義導航</a>
                <a href="{{url('admin/navs')}}"><i class="fa fa-recycle"></i>全部自定義導航</a>
            </div>
        </div>
    </div>
    <!--結果集標題與導航組件 結束-->


                <form action="{{url('admin/navs')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>自定義導航 中文名稱：</th>
                    <td>
                        <input type="text" name="nav_name_tw">
                        <span><i class="fa fa-exclamation-circle yellow"></i>自定義導航名稱必須填寫</span>
                    </td>
                </tr>
                <tr>
                    <th>自定義導航 英文名稱：</th>
                    <td>
                        <input type="text" class="lg" name="nav_name_en">
                        <p>標題可以寫30字</p>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>URL：</th>
                    <td>
                        <input type="text" class="lg " name="nav_url">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>排序：</th>
                    <td>
                        <input type="text" name="nav_order" style="width: 10px" value="0">
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