<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //echo \Session::get('admin')."<br><br>";
        if (!Session('admin')) {
            echo 'session is not value <br><br>';

            //  return redirect('admin_middleware/index');
        } else {
            echo Session::get('admin') . ' session is value <br><br>';
        }
        //echo 'middleware adminlogin new <br><br>';
        return $next($request);
    }
}
