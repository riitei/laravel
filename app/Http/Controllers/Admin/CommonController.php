<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    public function uploadPhotoFile()
    {
        $file = Input::file('Filedata'); // 使用uploadify套件 讀取name名稱為Filedata
        if($file -> isValid()){
            $entension = $file->getClientOriginalExtension(); //上傳文件後綴
            $name = request()->file('Filedata')->getClientOriginalName() . microtime(true) . "." . $entension;
            $file -> move('uploads/photo_file',$name); // config/filesystem.php
            $filepath = url('/uploads/photo_file/'.$name);
            return $filepath;
        }
    }
}
