<?php

namespace App\Http\Controllers\Admin;

use App\Http\Lib\Code\VerificationCode;

/*
 * require_once和include_once
   使用方法跟require、include一樣，差別在於在引入檔案前，會先檢查檔案是否已經在其他地方被引入過了，
   若有，就不會再重複引入。


   require和include的不同
   1. require適合用來引入靜態的內容，而include則適合用來引入動態的程式碼。
   2. include在執行時，如果include進來的檔案發生錯誤的話，會顯示警告，不會立刻停止；
   3. require 則是會顯示錯誤，立刻終止程式，不再往下執行。
   4. include可以用在迴圈；require不行。
 * */

class LoginController extends CommonController
{
    public function login()
    {
        return view('admin.login');
    }

    public function verificationCode()
    {
        $VerificationCode = new VerificationCode();
        return $VerificationCode->make();
    }

    public function getCode()
    {
        $VerificationCode = new VerificationCode();
        echo $VerificationCode->get();
    }
}
