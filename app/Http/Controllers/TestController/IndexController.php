<?php

namespace App\Http\Controllers\TestController;

use App\Http\Controllers\Controller;
use App\Http\Model\TestModel;

class IndexController extends Controller
{
    public function indexDB()
    {
//        $db =  DB::connection()->getPdo();
//        $user = DB::table('user')->where('user_id','<',2)->get();
//        dd($user);
        //$user = TestModel::all();
        // $user = TestModel::find(2);// 從主鍵id讀取地幾筆
        $TestModel = new TestModel();
        $TestModel->test();
    }
}
