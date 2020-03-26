<?php

declare(strict_types=1);

namespace Test\EasyPay;

date_default_timezone_set("Asia/Shanghai");

/**
 * 测试常量
 * Class Contains
 * @package Test\FuluOpenApi
 */
class Contains
{
    /** @var string 微信配置 */
    const WX_CONFIG = [
        'use_sandbox'  => true,// 是否使用 微信支付仿真测试系统
        'app_id'       => 'wxxxxxx',  // 公众账号ID
        'mch_id'       => 'xxxxx',// 商户id
        'md5_key'      => 'xxxxxxx',// md5 秘钥
        'app_cert_pem' => 'weixin_app_cert.pem',
        'app_key_pem'  => 'weixin_app_key.pem',
        'sign_type'    => 'MD5',// MD5  HMAC-SHA256
        'limit_pay'    => [
            //'no_credit',
        ],// 指定不能使用信用卡支付   不传入，则均可使用
        'fee_type'     => 'CNY',// 货币类型  当前仅支持该字段
        'notify_url'   => 'https://wap.demo.com/v1/notify/wx',
        'redirect_url' => 'https://wap.demo.com/',// 如果是h5支付，可以设置该值，返回到指定页面
        'return_raw'   => false,// 在处理回调时，是否直接返回原始数据，默认为true
    ];

    /**
     * 阿里配置
     */
    const ALI_CONFIG = [
        'use_sandbox' => true,// 是否使用沙盒模式

        'app_id'          => '2016073100130857',
        'sign_type'       => 'RSA2',// RSA  RSA2


        // ！！！注意：如果是文件方式，文件中只保留字符串，不要留下 -----BEGIN PUBLIC KEY----- 这种标记
        // 可以填写文件路径，或者密钥字符串  当前字符串是 rsa2 的支付宝公钥(开放平台获取)
        'ali_public_key'  => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmBjJu2eA5HVSeHb7jZsuKKbPp3w0sKEsLTVvBKQOtyb7bjQRWMWBI7FrcwEekM1nIL+rDv71uFtgv7apMMJdQQyF7g6Lnn9niG8bT1ttB8Fp0eud5L97eRjFTOa9NhxUVFjGDqQ3b88o6u20HNJ3PRckZhNaFJJQzlahCpxaiIRX2umAWFkaeQu1fcjmoS3l3BLj8Ly2zRZAnczv8Jnkp7qsVYeYt01EPsAxd6dRZRw3uqsv9pxSvyEYA7GV7XL6da+JdvXECalQeyvUFzn9u1K5ivGID7LPUakdTBUDzlYIhbpU1VS8xO1BU3GYXkAaumdWQt7f+khoFoSw+x8yqQIDAQAB',

        // 可以填写文件路径，或者密钥字符串  我的沙箱模式，rsa与rsa2的私钥相同，为了方便测试
        'rsa_private_key' => 'MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQC/z+Ue/oS0GjO2
myYrkdopw5qq6Ih/xlHBx0HBE0xA2dRinpMuZeI0LUUtN54UAUZbDz8rcaOCb0je
loeYolw54tadcIw4Q2hbdeJPplldJZyi1BDYtBJZvAveeRSidHdmBSUtOtCBXUBl
JUP3I8/R4c34Ii4Pm/K4vmhwLf/zqZAedKGhYP6m5q+p8sfBHRPy97/KluLPiSTR
FqGSRmd0IitUGK+KQ5qsAfJXyN1oVR4jBYaxfx7dWkTWmxAfNqtKfMvu2a5lH6hv
ClN+w4RUDBu3939bLjCYKcAomkv3QMquMP46m+D8Ny+3mGk5L9Ul4jyxlFTlV4L4
JM3g/02xAgMBAAECggEBALZliwseHDLnd6V9g56K41ozlzBOTv6yJ6yNPgnLwAcr
HLtq76p/V8smAVIuQTPkwnJ03S0CsumlyTVhDzAltG2XN14fWDdoYiQWxU3YccIR
shFkd2CaW5jZKLA1k1moRqHM4r1P4FYjxshn12l7tHNwtdvvJL3THcxvxABovauF
OVtznpRlnfJLjn2Lg+xNsxaYy3zL8L6nL7MXUWLKvmLiZn64PFcw7cf+9n2exRDs
wn0wDCpypGqOVVXVFeZaXTwmOoxgIUAZfAExdLtabGGCAz1lTsA0+r4DW2nSTe8C
Fy1Db+fcCTm+uQ3y6jDwuS3tB8V+PQKog3+ReZp/9sECgYEA/NEr+ln6DTy7u4rC
Wq7mixRJ1kaiAUph/hADrUwhkMiUapSMNAIXblFB+BQUjFZQmXEbcvz0Y70g9Zi9
JCXVTiDTBe7jj/FK63MU0F9KY5OducpVV+RhSpNy/i1M2qeW4gO351PpPHUpRUYr
GkYvAKktqrSOdBEWD3IeKLYDXxMCgYEAwjoavGjWzD9Xckbpb8yrQ+gHfLeWDKh7
BgvoBGagyqbzIOZU9wg3dSQ2F5eMWDxWVRGqap3fIHxcA0/VMqXG1DrvSIUC4SE8
Zys515fR00c9h3W3IugHnKgdYcV7nZrJoPZXlMjPOo39FCBnfbrUOgnKwxMlz3lV
vC6465ODhKsCgYEAmUtTuTd5kTE0O+FFO6s1iztAEjc94D5z8JNRR3EUITAeHgn4
gUiLYI7Qy1WRqA5mTMPyeuS6Ywe4xnJYrWRrVDY+/if9v7f1T5K2GirNdld5mb//
w41tGMUTQt/A7AwWRvEuP4v3rnr0DVcgp4vK0EHEuO9GOUZq8+6kLtc+cBUCgYBF
J/kzEsVAjmEtkHA33ZExqaFY1+l2clrziTPAtWYVIiK5mSmxl9xfOliER/KxzDIV
MigStEmpQH5ms3s/AGXuVVmz4aBn1rSyK2L6D9WnO9t9qv1dUW68aeOkV3OvZ1jZ
lj0S/flDaSEulGclDmvYinoGwX+aAyLy0VQIlUqj5wKBgHEUEf7YDnvw/IBnF1E4
983/7zBx9skoHhpEZsh2+1or7LIw6z0m3lsNBnK0MZZBmW/7HwOtVfhXUUPbVrOJ
di70YoMynX3gjK3LTXhzISheZgcNRKTqiJgVunPokJxQRyYcAfaQeuIm9O8cCPE1
rZpNAzCdd4NSj83UZRm3YOmC',

        'limit_pay'  => [
            //'balance',// 余额
            //'moneyFund',// 余额宝
            //'debitCardExpress',// 	借记卡快捷
            //'creditCard',//信用卡
            //'creditCardExpress',// 信用卡快捷
            //'creditCardCartoon',//信用卡卡通
            //'credit_group',// 信用支付类型（包含信用卡卡通、信用卡快捷、花呗、花呗分期）
        ],// 用户不可用指定渠道支付当有多个渠道时用“,”分隔

        // 与业务相关参数
        'notify_url' => 'https://wap.demo.com/v1/notify/ali',
        'return_url' => 'https://wap.demo.com/',

        'return_raw' => false,// 在处理回调时，是否直接返回原始数据，默认为 true
    ];

    const CMB_CONFIG = [
        'use_sandbox' => true,// 是否使用 招商测试系统

        'branch_no'   => 'xxx',  // 商户分行号，4位数字
        'merchant_no' => 'xxxx',// 商户号，6位数字
        'mer_key'     => 'xxxxxx',// 秘钥16位，包含大小写字母 数字

        // 招商的公钥，建议每天凌晨2:15发起查询招行公钥请求更新公钥。
        'cmb_pub_key' => 'xxxxx',

        'op_pwd'    => 'xxxxx',// 操作员登录密码。
        'sign_type' => 'SHA-256',// 签名算法,固定为“SHA-256”
        'limit_pay' => [
            //'A',
        ],// 允许支付的卡类型,默认对支付卡种不做限制，储蓄卡和信用卡均可支付   A:储蓄卡支付，即禁止信用卡支付

        'notify_url' => 'http://114.215.86.31/__readme/phpinfo.php',// 支付成功的回调

        'sign_notify_url' => 'http://114.215.86.31/__readme/phpinfo.php',// 成功签约结果通知地址

        'return_url' => 'https://wap.demo.com/',// 如果是h5支付，可以设置该值，返回到指定页面

        'return_raw' => false,// 在处理回调时，是否直接返回原始数据，默认为true
    ];

}