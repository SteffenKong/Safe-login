<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Tools\Rsa\RSACrypt;

/**
 * Class Admin
 * @package App\Model
 * 管理员模型
 */
class Admin extends Model
{

    protected $guarded = [];
    protected $table = 'admin';
    protected $primaryKey = 'id';

    /**
     * @param $account
     * @param $password
     * @return array|bool
     */
    public function login($account,$password) {
        //1.解密
        $rsa = new RSACrypt();
        $rsa->setPrivkey(config('secret.rsa.privateKey'));
        $dePass = $rsa->decryptByPrivateKey($password);
        //2.解密后的明文密码进行哈希加密
        $newPass = md5(md5($dePass));
        //3.对比数据库
        $admin = Admin::where('account',$account)->first();
        if(!$admin) {
            return false;
        }

        if($newPass !== $admin['password']) {
            return false;
        }

        return [
            'id'=>$admin->id,
            'account'=>$admin->account,
            'email'=>$admin->email,
            'createdAt'=>$admin->created_at
        ];
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
