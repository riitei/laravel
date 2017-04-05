<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Links;
use App\Http\Model\Navs;
use Illuminate\Http\Request;

class IndexController extends CommonController
{
    public function index()
    {
        // $navs =  Navs::orderBy('nav_order','asc')->get(); // 網站超連結導航
        // 重複 寫在 建構值
        //  return view('home.index',compact('navs'));
        //


        // url 最高六篇文章
        $article_url = Article::orderBy('art_view', 'desc')->take(3)->get();

        // take(6) 讀六筆
        //
        // 圖文列表 前五篇  （分頁效果）
        $article_photo = Article::orderBy('art_time', 'desc')->paginate(5);

        // paginate(5) 分頁 五頁 不需要get()
        //

        // 分享鏈結
        $article_link = Links::orderBy('link_order', 'asc')->get();

        // 配置項

        return view('home.index', compact
        ('article_url', 'article_photo', 'article_link'));

    }

    public function cate($cate_id)
    {
        //$cate = Category::where('cate_id',$cate_id)->get();
        $cate = Category::find($cate_id);
        // 圖文列表 前2篇  （分頁效果）
        $article = Article::where('cate_id', $cate_id)->orderBy('art_time', 'desc')->paginate(2);
        // $navs =  Navs::orderBy('nav_order','asc')->get(); // 網站超連結導航
        // 當前子分類
        $subCate = Category::where('cate_pid', $cate_id)->get();

        // 重複 寫在 建構值
        return view('home.list', compact('cate', 'article', 'subCate'));
    }

    public function article()
    {
        // $navs =  Navs::orderBy('nav_order','asc')->get(); // 網站超連結導航
        // 重複 寫在 建構值
        return view('home.new');
    }
}
