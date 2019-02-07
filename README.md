> aes
>> 自用对称加密类  
>> 官方文档：[点击进入](http://doc.job520.net/web/#/3?page_id=50)

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
// 5. 实例化mcrypt加密类
$obj = new mcrypt($key);
// 6. 实例化openssl加密类
$obj = new openssl($key);
// 7. aes加密
$encode = $obj->encrypt($data);
echo $encode . PHP_EOL;
// 8. aes解密
$decode = $obj->decrypt($encode);
echo $decode . PHP_EOL;
// 9. 私钥路径
$private_key = 'rsa_private_key.pem';
// 10. 公钥路径
$public_key = 'rsa_public_key.pem';
// 11. 实例化rsa加密解密类
$rsa = new rsa($private_key, $public_key);
// 12. 测试数据
$origin_data = '这是一条测试数据';
// 13. rsa私钥加密
$encrypt = $rsa->privEncrypt($origin_data);
echo '私钥加密后的数据为：' . $encrypt . PHP_EOL;
// 14. rsa公钥解密
$decrypt = $rsa->publicDecrypt($encrypt);
echo '公钥解密后的数据为: ' . $decrypt . PHP_EOL;
```
3. 输出：
```
bi9OanYvOU5NV1Q0REtGU1RvUTduZz09OjrBhwdu3owVn02EkKK6KCU7
你好 world
私钥加密后的数据为：TM6JDriSABTS3otd80JGzLSEzQpnL8LhvoWxJXwN1gSdCRy6lrUvI/vd80rrRRtW8qsmq5HLUpfU+J0jeyJqYIu7hpzVem9XPqOGS2LdsxuIyARCj37xZ2a9np/xhl/HIKCj9DlVOjpMbKJXPPvrblxz+4P5vHWPIzwTNGa9pPs=
公钥解密后的数据为: 这是一条测试数据
```
