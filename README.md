> encryption
>> 自用对称加密类  
>> 官方文档：[点击进入](http://doc.job520.net/web/#/1?page_id=49)

### 1. 引入：
1. 下载：  
`
composer require job520/encryption
`
2. 引入：  
`
require_once "vendor/autoload.php";
`
### 2. 用法：
1. 生成密钥对：
```
openssl genrsa -out rsa_private_key.pem 1024
openssl pkcs8 -topk8 -inform PEM -in rsa_private_key.pem -outform PEM -nocrypt -out private_key.pem
openssl rsa -in rsa_private_key.pem -pubout -out rsa_public_key.pem
```
2. 示例代码：
```
<?php
// 1. 引入包
require_once 'vendor/autoload.php';
// 2. 使用命名空间
use job520\mcrypt;
use job520\openssl;
use job520\rsa;
// 3. 定义密钥
$key = 'abcdefg';
// 4. 原始数据
$data = '你好 world';
// 5. 实例化 mcrypt 加密类
$obj = new mcrypt($key);
// 6. 实例化 openssl 加密类
$obj = new openssl($key);
// 7. aes 加密
$encode = $obj->encrypt($data);
echo $encode . PHP_EOL;
// 8. aes 解密
$decode = $obj->decrypt($encode);
echo $decode . PHP_EOL;
// 9. 私钥路径
$private_key = 'rsa_private_key.pem';
// 10. 公钥路径
$public_key = 'rsa_public_key.pem';
// 11. 实例化 rsa 加密解密类
$rsa = new rsa($private_key, $public_key);
// 12. 测试数据
$origin_data = '这是一条测试数据';
// 13. rsa 公钥加密
$encrypt = $rsa->publicEncrypt($origin_data);
echo '公钥加密后的数据为：' . $encrypt . PHP_EOL;
// 14. rsa 私钥解密
$decrypt = $rsa->privDecrypt($encrypt);
echo '私钥解密后的数据为: ' . $decrypt . PHP_EOL;
```
3. 输出：
```
eUVVWkZraUw3STNmajhLKzVjdWFvUT09OjrkovuKfPHwPnqVEtm4os+U
你好 world
公钥加密后的数据为：soOTP7h5C8zzx+3YcuhMYkQ5NXNrBxt3s5/drwf/66CfVspyTvNBXmF0TezdsNKZPlztLhDHGICOUAHttl1ePoOIuymY9t2Jcd1oJitjI99WKfvkR7gwBEKLZrk5xD4LHVBknP+X8ww4CaLgSOz/gdiwJ5nt2VJ58GoKUc2ba8s=
私钥解密后的数据为: 这是一条测试数据
```
