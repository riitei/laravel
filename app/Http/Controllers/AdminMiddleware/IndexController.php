<?php

namespace App\Http\Controllers\AdminMiddleware;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function index()
    {
        // \Session::put('admin','1');
        return 'index';
    }

    public function login()
    {
        return 'login';
    }
}
