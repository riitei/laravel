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
<div class="header">layout 公用頭部</div>
{{--@yield('content')  或使用 --}}
@yield('content')
@section('content')
    <p>需要加入這對內容 要加入 @ parent</p>
@show
<div class="footer" style="height: 100px;background: lightblue">layout 公用底部內容</div>

</html>