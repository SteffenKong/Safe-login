<?php

namespace App\Http\Middleware;

use App\Model\Admin;
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

        $token = $request->header('token');

        if(!$token) {
            jsonPrint('001','未登录');
        }

        $adminModel = new Admin();
        $admin = $adminModel->getLoginAdmin();
        if(!$admin) {
            return jsonPrint('001','token非法');
        }
        $response =  $next($request);
        return $response;
    }
}
