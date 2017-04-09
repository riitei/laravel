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
        // 查看次數自增

        Category::where('cate_id', $cate_id)->increment('cate_view');

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

    public function article($art_id)
    {
        // 查看次數自增

        Article::where('art_id', $art_id)->increment('art_view');
//        $view = Article::where('art_id', $art_id)->first();
//        Article::where('art_id', $art_id)->update(['art_view' => ($view->art_view + 1)]);

        // $article = Article::find($art_id);
        $article = Article::Join('category', 'article.cate_id', '=', 'category.cate_id')->
        where('art_id', $art_id)->first();
        $article['UP'] = Article::where('art_id', '<', $art_id)->orderBy('art_id', 'desc')->first();
        $article['DN'] = Article::where('art_id', '>', $art_id)->orderBy('art_id', 'asc')->first();
        $article_data = Article::where('cate_id', $art_id)->take(2)->get();
        // $navs =  Navs::orderBy('nav_order','asc')->get(); // 網站超連結導航
        // 重複 寫在 建構值
        return view('home.new', compact('article', 'article_data'));
    }
}
