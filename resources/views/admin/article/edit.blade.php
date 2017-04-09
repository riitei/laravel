@extends('layouts.admin')
@section('admin-content')
    <!--麵包屑導航 開始-->

        <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
    <a href="{{url('admin/info')}}">首頁</a> &raquo; 文章管理
    <!--麵包屑導航 结束-->

    <!--結果集標題與導航組件 開始-->


    <h3>編輯文章</h3>
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


    <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
                <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
    <!--結果集標題與導航組件 结束-->


    <form action="{{url('admin/article/'.$article->art_id)}}" method="post">
            {{method_field('put')}}
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th width="120"><i class="require">*</i>父集文章：</th>
                    <td>
                        <select name="cate_id">
                            <option value="0">==頂級文章==</option>
                            @foreach($category as $value)
                                <option value="{{$value->cate_id}}"
                                        @if($article->cate_id ==$value->cate_id)
                                        selected
                                        @endif
                                >{{$value->_cate_name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <tr>
                    <th><i class="require">*</i>文章標題：</th>
                    <td>
                        <input type="text" class="lg" name="art_title" value="{{$article->art_title}}">
                    </td>
                </tr>
                <tr>
                    <th>編輯：</th>
                    <td>
                        <input type="text" class="sm" name="art_edit" value="{{$article->art_edit}}">
                    </td>
                </tr>
                <tr>
                    <th>縮圖：</th>
                    <td>
                        <input type="text" size="50" name="art_thumb" value="{{$article->art_thumb}}">
                        <input id="file_upload" name="file_upload" type="file" multiple="true">
                        <script src="{{asset('js/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
                        <link rel="stylesheet" type="text/css" href="{{asset('js/uploadify/uploadify.css')}}">

                        <script type="text/javascript">
                            {{$timestamp = time()}}
                            $(function () {
                                $('#file_upload').uploadify({
                                    'buttonText': '圖片上傳 ',
                                    'formData': {
                                        'timestamp': '{{$timestamp}}',
                                        '_token': '{{csrf_token()}}'
                                    },
                                    'swf': "{{asset('js/uploadify/uploadify.swf')}}",
                                    'uploader': "{{url('admin/upload')}}",
                                    'onUploadSuccess': function (file, data, response) {
                                        $('input[name=art_thumb]').val(data);
                                        $('#art_thumb_img').attr('src', data);
                                    }
                                });
                            });
                        </script>
                        <style>
                            .uploadify {
                                display: inline-block;
                            }

                            .uploadify-button {
                                border: none;
                                border-radius: 5px;
                                margin-top: 8px;
                            }

                            table.add_tab tr td span.uploadify-button-text {
                                color: #FFF;
                                margin: 0;
                            }
                        </style>
                    </td>

                </tr>
                <tr>
                    <th></th>
                    <td>
                        <img src="{{$article->art_thumb}}" id="art_thumb_img"
                             style="max-width: 350px; max-height:100px;">
                    </td>
                </tr>
                <tr>
                    <th>關鍵詞：</th>
                    <td>
                        <input type="text" class="lg" name="art_tag" value="{{$article->art_tag}}">
                    </td>
                </tr>
                <tr>
                    <th>描述：</th>
                    <td>
                        <textarea name="art_description">{{$article->art_description}}</textarea>
                    </td>
                </tr>

                <tr>
                    <th><i class="require">*</i>文章內容：</th>
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
                                src="{{asset('js/ueditor/lang/zh-cn/zh-tw.js')}}">

                        </script>
                        {{--版面 id 設定 name--}}
                        {{-- {!!  !!} 將標籤顯示--}}
                        <script
                                id="editor" name="art_content" type="text/plain"
                                style=" width:860px;height:500px;">
                            {!! $article->art_content !!}

                        </script>
                        {{--實作--}}
                        <
                        script;
                        type = "text/javascript" >;
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

@endsection
