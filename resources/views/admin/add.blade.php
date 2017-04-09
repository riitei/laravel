@extends('layouts.admin')
@section('admin-content')
<!--面包屑导航 开始-->

    <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
<a href="{{url('admin/info')}}">首頁</a> &raquo; 添加文章分類
<!--面包屑导航 结束-->

<!--結果集標題與導航組件 開始-->


<h3>快捷操作</h3>



<a href="#"><i class="fa fa-plus"></i>新增文章</a>
            <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
            <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
<!--結果集標題與導航組件 結束-->


<form action="#" method="post">
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>分类：</th>
                <td>
                    <select name="">
                        <option value="">==請選擇==</option>
                        <option value="19">精品界面</option>
                        <option value="20">推荐界面</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>标题：</th>
                <td>
                    <input type="text" class="lg" name="">
                    <p>标题可以写30个字</p>
                </td>
            </tr>
            <tr>
                <th>作者：</th>
                <td>
                    <input type="text" name="">
                    <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>价格：</th>
                <td>
                    <input type="text" class="sm" name="">元
                    <span><i class="fa fa-exclamation-circle yellow"></i>这里是短文本长度</span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>缩略图：</th>
                <td><input type="file" name=""></td>
            </tr>
            <tr>
                <th>单选框：</th>
                <td>
                    <label for=""><input type="radio" name="">单选按钮一</label>
                    <label for=""><input type="radio" name="">单选按钮二</label>
                </td>
            </tr>
            <tr>
                <th>复选框：</th>
                <td>
                    <label for=""><input type="checkbox" name="">复选框一</label>
                    <label for=""><input type="checkbox" name="">复选框二</label>
                </td>
            </tr>
            <tr>
                <th>描述：</th>
                <td>
                    <textarea name="discription"></textarea>
                </td>
            </tr>
            <tr>
                <th>详细内容：</th>
                <td>
                    <textarea class="lg" name="content"></textarea>
                    <p>标题可以写30个字</p>
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