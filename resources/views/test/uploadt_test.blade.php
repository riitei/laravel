<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>上傳</title>
    <script language="JavaScript" type="text/javascript" src="{{asset('/js/jquery-3.1.1.js')}}"></script>

</head>
<br>
<body>

<form id="uploadForm" action="{{url('upload')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
<input type="file" id="photo" name="photo"><br>
<input type="text" id="test02" name="test02">

<br>
<input type="button" id="upload_file" value="送出">
</form>

</body>

</html>


<script>

    $(function () {
        $('#upload_file').click(function () {
            console.log('01_' + $('#photo').val());
            console.log('02_' + $('#test02').val());
            console.log('03_' + $(this).val());
            $.post('{{url('upload')}}',{
                'test':$('#photo').val(),
                '_token':'{{csrf_token()}}'
            },function () {

            });
        });
    });


    {{--$(function () {--}}
    {{--$('#upload_file').mouseup(function () {--}}
    {{--$.post('{{url('admin/upload')}}', {--}}
    {{--'photo': $('#photo').val(),--}}
    {{--'_token': '{{csrf_token()}}'--}}
    {{--}, function () {--}}
    {{--});--}}

    {{--});--}}
    //    });
</script>

