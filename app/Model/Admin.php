<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Tools\Rsa\RSACrypt;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parser;

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
        $builder = new Builder();
        $exp = config('secret.jwt.exp');
        $Singer = new Sha256();
        $privateKey = config('secret.jwt.privateKey');
        $builder->setIssuedAt(time());
        $builder->setExpiration(time()+$exp);
        $builder->setAudience('login.com');
        $builder->setId($admin['id']);
        $builder->setSubject('http://login.com');
        $builder->sign($Singer,$privateKey);
        $token = (string)$builder->getToken();
        return $token;
    }


    /**
     * @param $token
     * @return bool
     */
    public function getLoginAdmin($token) {
        if(empty($token)) {
            return false;
        }
        $privateKey = config('secret.jwt.privateKey');
        $signer = new Sha256();
        $parser = new Parser();
        $res = $parser->parse($token);
        if(!$res->verify($signer,$privateKey)) {
            //token不合法
            return false;
        }
        //验证token是否过期
        if($res->isExpired()) {
            //token过期
            return false;
        }
        $token = $res->getClaims();
        $tokenStr = json_encode($token);
        $tokens = json_decode($tokenStr,true);
        $id = $tokens['jti'];
        $admin = Admin::where('id',$id)->first(['id','account','email','status','updated_at','created_at']);
        return $admin;
    }


    /**
     * @param $adminId
     * @return bool
     * 获取管理员状态
     */
    public function getStatus($adminId) {
        $status = Admin::where('id',$adminId)->value('status') ?? '';
        return (bool)$status;
    }
}
