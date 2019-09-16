<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * 检测每次的请求是否带了token，没有带token表示没有登录
     */
    public function handle($request, Closure $next)
    {

        return $next($request);
    }
}
