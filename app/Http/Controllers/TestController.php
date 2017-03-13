<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function testDB()
    {
        $connection = DB::connection()->getPdo();
        dd($connection);
    }

    public function crypt()
    {
        $aa = 'admin';
        echo Crypt::encrypt($aa);
    }
}

