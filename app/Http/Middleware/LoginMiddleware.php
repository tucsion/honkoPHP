<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //判断session用户是否有值
        if(empty(session('admin')))
        {
            return redirect('/admin/login')->with(['info'=>'请先登陆']);
        }


        return $next($request);
    }
}
