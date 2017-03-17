@extends('layouts.admin')
@section('admin-content')
    <!--麵包屑導航 開始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首頁</a> &raquo; 文章管理
    </div>
    <!--麵包屑導航 结束-->

    <!--結果集標題與導航組件 開始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>添加文章</h3>
            @if(count($errors)>0)
                <div class="mark">
                    @if(is_object($errors))
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    @else
                        <p>{{$errors}}</p>
                    @endif
                </div>
            @endif
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
                <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
            </div>
        </div>
    </div>
    <!--結果集標題與導航組件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/article')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th width="120"><i class="require">*</i>父集文章：</th>
                    <td>
                        <select name="cate_pid">
                            <option value="0">==頂級文章==</option>
                            @foreach($article as $value)
                                <option value="{{$value->cate_id}}">{{$value->_cate_name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <tr>
                    <th>文章標題：</th>
                    <td>
                        <input type="text" class="lg" name="art_title">
                    </td>
                </tr>
                <tr>
                    <th>編輯：</th>
                    <td>
                        <input type="text" class="sm" name="art_edit">
                    </td>
                </tr>
                <tr>
                    <th>縮圖：</th>
                    <td>
                        <input type="text" size="50" name="art_thumb">
                    </td>
                </tr>
                <tr>
                    <th>關鍵詞：</th>
                    <td>
                        <input type="text" class="lg" name="art_tag"></input>
                    </td>
                </tr>
                <tr>
                    <th>描述：</th>
                    <td>
                        <textarea name="art_description"></textarea>
                    </td>
                </tr>

                <tr>
                    <th>文章內容：</th>
                    <td>
                        {{--套件引用--}}
                        <script
                                type="text/javascript" charset="utf-8"
                                src="{{asset('js/ueditor/ueditor.config.js')}}">

                        </script>
                        <script
                                type="text/javascript" charset="utf-8"
                                src="{{asset('js/ueditor/ueditor.all.min.js')}}">
                        </script>
                        <script
                                type="text/javascript" charset="utf-8"
                                src="{{asset('js/ueditor/lang/zh-cn/zh-tw.js')}}"></script>
                        {{--版面 id 設定 name--}}
                        <script
                                id="editor" name="art_content" type="text/plain"
                                style="width:860px;height:500px;">
                        </script>
                        {{--實作--}}
                        <script type="text/javascript">
                            var ue = UE.getEditor('editor');
                        </script>
                        {{--ueditor編輯器樣式矯正--}}
                        <style>
                            .edui-default {
                                line-height: 28px;
                            }

                            div.edui-combox-body, div.edui-button-body, div.edui-splitbutton-body {
                                overflow: hidden;
                                height: 20px;
                            }

                            div.edui-box {
                                overflow: hidden;
                                height: 22px;
                            }
                        </style>
                        {{--ueditor編輯器樣式矯正--}}
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