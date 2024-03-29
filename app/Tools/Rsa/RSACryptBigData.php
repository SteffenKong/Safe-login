<?php
namespace App\Tools\Rsa;

/**
 * Class RSACryptBigData
 * @package App\Tools\Rsa
 */
class RSACryptBigData
{
    /**
     * 公钥加密
     * @param $data
     * @param string $publickey
     * @return string
     */
    public function encryptByPublicKey_data($data, $publickey = '')
    {
        $RSACrypt = new RSACrypt();

        if ($publickey != '') {
            $RSACrypt->setPubkey($publickey);
        }
        $crypt_res = '';
        for ($i = 0; $i < ((strlen($data) - strlen($data) % 117) / 117 + 1); $i++) {
            $crypt_res = $crypt_res . ($RSACrypt->encryptByPublicKey(mb_strcut($data, $i * 117, 117, 'utf-8')));
        }
        return $crypt_res;
    }

    /**
     * 私钥解密
     * @param $data
     * @param string $privatekey
     * @return string
     */
    public function decryptByPrivateKey_data($data, $privatekey = '')
    {
        $RSACrypt = new RSACrypt();

        if ($privatekey != '') {  // if null use default
            $RSACrypt->setPrivkey($privatekey);
        }
        $decrypt_res = '';
        $datas = explode('@', $data);
        foreach ($datas as $value) {
            $decrypt_res = $decrypt_res . $RSACrypt->decryptByPrivateKey($value);
        }
        return $decrypt_res;
    }

    /**
     * 私钥加密
     * @param $data
     * @param string $privatekey
     * @return string
     */
    public function encryptByPrivateKey_data($data, $privatekey = '')
    {
        $RSACrypt = new RSACrypt();

        if ($privatekey != '') {
            $RSACrypt->setPrivkey($privatekey);
        }
        $crypt_res = '';
        for ($i = 0; $i < ((strlen($data) - strlen($data) % 117) / 117 + 1); $i++) {
            $crypt_res = $crypt_res . ($RSACrypt->encryptByPrivateKey(mb_strcut($data, $i * 117, 117, 'utf-8')));
        }
        return $crypt_res;
    }

    /**
     * 公钥解密
     * @param $data
     * @param string $publickey
     * @return string
     */
    public function decryptByPublicKey_data($data, $publickey = '')
    {
        $RSACrypt = new RSACrypt();

        if ($publickey != '') {
            $RSACrypt->setPrivkey($publickey);
        }
        $decrypt_res = '';
        $datas = explode('@', $data);
        foreach ($datas as $value) {
            $decrypt_res = $decrypt_res . $RSACrypt->decryptByPublicKey($value);
        }
        return $decrypt_res;
    }
}
