@extends('layouts.admin')
@section('admin-content')
    <!--面包屑导航 开始-->

        <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
    <a href="{{url('admin/info')}}">首頁</a> &raquo; 設定檔 管理
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


    <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>新增設定檔</a>
                <a href="{{url('admin/config')}}"><i class="fa fa-recycle"></i>全部設定檔</a>
    <!--結果集標題與導航組件 結束-->


    <form action="{{url('admin/config')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>設定檔標題：</th>
                    <td>
                        <input type="text" class="lg" name="conf_title">
                        <span><i class="fa fa-exclamation-circle yellow"></i>設定檔名稱必須填寫</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>設定檔名稱：</th>
                    <td>
                        <input type="text" name="conf_name">
                        <span><i class="fa fa-exclamation-circle yellow"></i>設定檔名稱必須填寫</span>
                    </td>
                </tr>
                <tr>
                    <th>類型：</th>
                    <td>
                        <input type="radio" name="field_type" value="input" checked onclick="showValue()">input
                        <input type="radio" name="field_type" value="textarea" onclick="showValue()">textarea
                        <input type="radio" name="field_type" value="radio" onclick="showValue()">radio
                        <span><i class="fa fa-exclamation-circle yellow">

                            </i>類型:input textarea radio
                        </span>

                    </td>
                </tr>
                <tr class="show_value">
                    <th>類型值：</th>
                    <td>
                        <input type="text" class="lg " name="field_value"><br>
                        <span><i class="fa fa-exclamation-circle yellow">

                            </i>類型值: 只有 radio 的情況下才需要配置 格式 1|開啟,0|關閉
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>排序：</th>
                    <td>
                        <input type="text" name="conf_order" style="width: 50px" value="0">
                    </td>
                </tr>
                <tr>
                    <th>說明：</th>
                    <td>
                        <textarea name="conf_tips" value="0"></textarea>
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
    <script>
        showValue(); // 初始化

        function showValue() {
            var typeValue = $('input[name=field_type]:checked').val(); // 標籤['屬性=值']
            if (typeValue == 'radio') {
                $('.show_value').show();
            } else {
                $('.show_value').hide();// 隐藏
            }

        }
        //        $('.show_value').hide();// 初始
        //        $(function () {
        //            // 標籤['屬性=值']
        //            $('input[name=field_type]').change(function () {
        //                if ($(this).val() == 'radio') {
        //                    $('.show_value').show();
        //                } else {
        //                    $('.show_value').hide();// 隐藏
        //                }
        //            });
        //        });
    </script>
@endsection