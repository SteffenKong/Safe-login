<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class IndexController
 * @package App\Http\Controllers\Admin
 * 首页控制器
 */
class IndexController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 首页展示
     */
    public function index(Request $request) {
        $adminModel = new Admin();
        $token = request()->header('token');
dd($token);
        $admin = $adminModel->getLoginAdmin($token);

        return view('/admin/index/index');
    }
}
