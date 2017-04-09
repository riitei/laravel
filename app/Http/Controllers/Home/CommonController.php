<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Navs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    public function __construct()
    {
        $navs = Navs::orderBy('nav_order', 'asc')->get(); // 網站超連結導航
        // 點擊量 最高六篇文章
        $article_hot = Article::orderBy('art_view', 'desc')->take(4)->get();

        // take(6) 讀六筆

        // 最新發布文章８篇
        $article_new = Article::orderBy('art_time', 'desc')->take(5)->get();
        // take(8) 讀8筆
        //

        View::share('navs', $navs); //  blade 共享 view
        View::share('article_hot', $article_hot); //  blade 共享 view
        View::share('article_new', $article_new); //  blade 共享 view

    }
}
