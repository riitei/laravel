<?php

namespace App\Http\Controllers\TestController;

use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function blabe()
    {
        /* 把參數傳到 view
         * */
        $name = null;
        $year = 1988;
        $data = [
            'name' => $name,
            'year' => $year,
            'airport' => [
                0 => 'TPE',
                1 => 'TSA',
                2 => 'SHA',
                3 => 'PVG'
            ],
            'airports' => [
                //  'TPE', 'TSA', 'SHA', 'PVG'
            ]
        ];

        $city = '<script>document.write("重慶萬州")</script>';
        // return view('test.my_laravel')->with('name',$name)->with('year',$year);
        // return view('test.my_laravel',$data);
        return view('test.my_laravel', compact('data', 'name', 'city'));
    }

    public function subViewIndexInclude()
    {
        return view('test.subview_include.index');
    }

    public function subViewInclude()
    {
        return view('test.subview_include.subview');
    }

    public function subViewLayouts()
    {
        echo config('database.connections.mysql.database');
        exit;
        return view('test.subview_layout.home');
    }
}
