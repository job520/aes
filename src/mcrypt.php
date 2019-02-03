<?php

namespace job520;
/**
 * @desc：php aes加密解密类
 * @author [Lee] <[<complet@163.com>]>
 */
class mcrypt
{
    // cast-128  gost  rijndael-128  twofish  cast-256  loki97  rijndael-192  saferplus  wake  blowfish-compat  des  rijndael-256  serpent  xtea  blowfish  enigma  rc2  tripledes  arcfour
    private $cipher = 'AES-256-CBC';
    // cbc  cfb  ctr  ecb  ncfb  nofb  ofb  stream
    private $mode = 'stram';
    // MCRYPT_RAND  MCRYPT_DEV_RANDOM  MCRYPT_DEV_URANDOM
    private $source = MCRYPT_RAND;
    private $key;

    /*
     构造函数
     @param key 密钥
     @param type 加密类型：1、mcrypt；2、openssl
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    private function getiv()
    {
        $cipher = $this->cipher;
        $mode = $this->mode;
        $source = $this->source;
        $size = mcrypt_get_iv_size($cipher, $mode);
        $iv = mcrypt_create_iv($size, $source);
        return $iv;
    }

    public function encrypt($data)
    {
        $cipher = $this->cipher;
        $mode = $this->mode;
        $key = $this->key;
        $iv = $this->getiv();
        $td = mcrypt_module_open($cipher, "", $mode, "");
        mcrypt_generic_init($td, $key, $iv);
        $encrypted = mcrypt_generic($td, $data);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $ret = base64_encode($encrypted);
        return $ret;
    }

    public function decrypt($data)
    {
        $cipher = $this->cipher;
        $mode = $this->mode;
        $key = $this->key;
        $iv = $this->getiv();
        $td = mcrypt_module_open($cipher, "", $mode, "");
        mcrypt_generic_init($td, $key, $iv);
        $decode = base64_decode($data);
        $dencrypted = mdecrypt_generic($td, $decode);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $ret = $dencrypted;
        return $ret;
    }
}

//$key = 'abcdefg';
//$data = '你好 world';
//$obj = new mcrypt($key);
//$encode = $obj->encrypt($data);
//echo $encode . PHP_EOL;
//$decode = $obj->decrypt($encode);
//echo $decode . PHP_EOL;