<?php

namespace App\Http\Controllers\AdminRouteGroup;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function index()
    {
        return 'index';
    }

    public function login()
    {
        return 'login';
    }
}
