<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\AuthorizeException;
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

    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new Admin();
    }


    /**
     * @param Request $request
     * @return false|string
     * @throws AuthorizeException
     * 获取管理员数据
     */
    public function getIndexData(Request $request) {
        $admin = $this->adminModel->getLoginAdmin();
        if(!$admin) {
            throw new AuthorizeException('token非法');
        }
        return jsonPrint('000','获取成功',['admin'=>$admin]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 首页展示
     */
    public function index() {
        return view('/admin/index/index');
    }
}
