<?php
namespace App\Traits;

use Illuminate\Support\Facades\Redis;

trait login {

    /**
     * @param $adminId
     * 设置key
     */
    public function setLogin($adminId) {
        $prefix = config('misc.redis.login_key');
        Redis::set($prefix.':'.$adminId,$adminId);
    }


    /**
     * @param $adminId
     * 注销删除redis的值
     */
    public function logout($adminId) {
        $prefix = config('misc.redis.login_key');
        Redis::delete($prefix.':'.$adminId);
    }

    /**
     * @param $adminId
     * @return mixed
     * 检测是否已经登录
     */
    public function getLoginStatusById($adminId) {
        $prefix = config('misc.redis.login_key');
        $key = $prefix.':'.$adminId;
        return Redis::exists($key);
    }
}
