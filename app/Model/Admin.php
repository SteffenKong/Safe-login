<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Admin
 * @package App\Model
 * 管理员模型
 */
class Admin extends Model
{

    public function login() {
        //TODO
    }

    /**
     * @param $admin
     * 通过admin生成一个token
     */
    public function getTokenByAdmin($admin) {
        //TODO
    }

    /**
     * 解开token获取admin信息
     */
    public function getLoginAdmin() {
        //TODO
    }

    /**
     * @param $adminId
     * 获取管理员状态
     */
    public function getStatus($adminId) {

    }
}
