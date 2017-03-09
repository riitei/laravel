<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function testDB()
    {
        $connection = DB::connection()->getPdo();
        dd($connection);
    }
}
