<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Navs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    public function __construct()
    {
        $navs = Navs::orderBy('nav_order', 'asc')->get(); // 網站超連結導航
        View::share('navs', $navs); //  blade 共享 view
    }
}
