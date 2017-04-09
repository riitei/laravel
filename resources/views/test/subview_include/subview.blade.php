<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

</head>
<style>
    .header {
        height: 100px;
        background: aquamarine
    }

    .middle {
        height: 200px;
        background: #f7e1b5;
    }
</style>
{{--引用子視窗 並傳遞參數--}}
@include('test.subview_include.header',['page'=>'傳遞參數'])
<div class="middle">內容</div>
@include('test.subview_include.footer')
</html>