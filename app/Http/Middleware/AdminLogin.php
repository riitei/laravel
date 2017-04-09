<?php

namespace App\Http\Middleware;

use Closure;

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
        // echo 'middleware_'.$request->session()->get('user')."<br>";
//        // 方法一
//        if(!session('user')){
//           return redirect('admin/login');// 加上這一句出現 就出錯
//        }
//        // 方法二
//        if(!Session::get('user')){
//            return redirect ('admin/login');// 加上這一句出現 就出錯
//        }
        // 方法三
        if (!$request->session()->has('user')) {
            return redirect('admin/login');// 加上這一句出現 就出錯
        }
        return $next($request);
    }
}
