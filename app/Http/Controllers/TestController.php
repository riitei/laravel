<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()
    {
        return view('test.uploadt_test');
    }

    public function upload(Request $request)
    {
        if ($request->file('photo')->isValid()) {
            echo $request->file('photo')->getClientOriginalName();
        } else {
            echo 'error';
        }
    }

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

