<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\LoginRequest;


/**
 * Class LoginController
 * @package App\Http\Controllers\Admin
 * 登录控制器
 */
class LoginController extends Controller
{

    protected $adminModel = null;

    public function __construct()
    {
        $this->adminModel = new Admin();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 登录界面
     */
    public function login() {
        return view('/admin/login/login');
    }

    /**
     * @param LoginRequest $request
     * @return false|string
     * 登录动作
     */
    public function sign(LoginRequest $request) {
        $data = $request->post();
        $admin = $this->adminModel->login($data['account'],$data['password']);

        if(!$admin) {
            return jsonPrint('001','登录失败');
        }
        return jsonPrint('000','登录成功');
    }

    /**
     * @return false|string
     * 获取加密的公钥
     */
    public function getPublicKey() {
        return jsonPrint('000','获取成功',['publicKey'=>config('secret.rsa.publicKey')]);
    }

    public function logout() {

    }
}
