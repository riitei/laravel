<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Navs;
use Illuminate\Http\Request;

class IndexController extends CommonController
{
    public function index()
    {
        // $navs =  Navs::orderBy('nav_order','asc')->get(); // 網站超連結導航
        // 重複 寫在 建構值
        //  return view('home.index',compact('navs'));
        return view('home.index');

    }

    public function cate()
    {
        // $navs =  Navs::orderBy('nav_order','asc')->get(); // 網站超連結導航
        // 重複 寫在 建構值
        return view('home.list');
    }

    public function article()
    {
        // $navs =  Navs::orderBy('nav_order','asc')->get(); // 網站超連結導航
        // 重複 寫在 建構值
        return view('home.new');
    }
}
