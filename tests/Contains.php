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
        'use_sandbox'        => true,// 是否使用沙盒模式
                'app_id'             => '2016073100130857',//普通公钥方式
                'cert_type'          => 0,//0=普通公钥方式,1=公钥证书方式
//        'app_id'             => '2016101800714838',//公钥证书方式
//        'cert_type'          => 1,//0=普通公钥方式,1=公钥证书方式
        'sign_type'          => 'RSA2',// RSA  RSA2
        //todo 公钥证书方式 应用公钥证书
        'merchantCertPath'   => '-----BEGIN CERTIFICATE-----
MIIDjzCCAnegAwIBAgIQICAFEizwTh/+q01Id7TKuTANBgkqhkiG9w0BAQsFADCBkTELMAkGA1UE
BhMCQ04xGzAZBgNVBAoMEkFudCBGaW5hbmNpYWwgdGVzdDElMCMGA1UECwwcQ2VydGlmaWNhdGlv
biBBdXRob3JpdHkgdGVzdDE+MDwGA1UEAww1QW50IEZpbmFuY2lhbCBDZXJ0aWZpY2F0aW9uIEF1
dGhvcml0eSBDbGFzcyAyIFIxIHRlc3QwHhcNMjAwNTEyMDk0MjUwWhcNMjMwNTExMDk0MjUwWjBh
MQswCQYDVQQGEwJDTjEVMBMGA1UECgwM5rKZ566x546v5aKDMQ8wDQYDVQQLDAZBbGlwYXkxKjAo
BgNVBAMMITIwODgxMDIxODAxMjAxMDAtMjAxNjEwMTgwMDcxNDgzODCCASIwDQYJKoZIhvcNAQEB
BQADggEPADCCAQoCggEBAJNHpNUzEfJNCbHi6CwVH2lSE84tIpnxzVdZ0LR18wikxW9djz/mvwJE
XL0sVUTigdXSy4k6DlM0zyHzC+iYque0b6ob1uA+8DNoakZvv1iGt8g07WjQeQafmo8NMkenmUvS
KxKUkl/boFIojL0q8j4Js16K4BUumqhW7RVJ0eiCEDsr0/B69PVLbdkzlIHDwgV6JIZ2K7+XYVWQ
JZtgONttlq3djmvaJCdz4T11Lk83YFm1q7Qd5Ce3MseBtkL8IWxsYImxnk8QAIVWOEOWvHzLPlYB
5uqfb7/QTG3VIlPP/svE5DIkBojgcP72izNhpPpx30mZ1JNieDKfnMwLtdMCAwEAAaMSMBAwDgYD
VR0PAQH/BAQDAgTwMA0GCSqGSIb3DQEBCwUAA4IBAQA48ensbeT9M3oxNvK4QqR+Bz4jq54pa9rn
+hdl2vlbjPhlJjp/Ur9ZJNXAfnk/cew6UQTqzZNDSSnTdx5W3tYUMcWlmBdfh5Pjqps+biS3G+oE
/VPi9nmB9KeVee+woI9fzeT8HrsM2omEfW+7vOttcOHqlAIvGkaVwDfLoZJ+0k7yWqfKZybC59H/
hO+NEjL0Oo5rQURqp3vbMMwkE1NyeAAchcWoiXgz9zIPlVh42IeCrO9bce7w2tI+OoOitdqAm16R
43pqHf47+dTobluPK/K7yYj1HuSAKrTM9I5u0z/ChXDuMARLchjWPqMiZFWjp79J9MSZ0M+6/eKm
aMJU
-----END CERTIFICATE-----',
        //todo 公钥证书方式 支付宝根证书
        'alipayRootCertPath' => '-----BEGIN CERTIFICATE-----
MIIBszCCAVegAwIBAgIIaeL+wBcKxnswDAYIKoEcz1UBg3UFADAuMQswCQYDVQQG
EwJDTjEOMAwGA1UECgwFTlJDQUMxDzANBgNVBAMMBlJPT1RDQTAeFw0xMjA3MTQw
MzExNTlaFw00MjA3MDcwMzExNTlaMC4xCzAJBgNVBAYTAkNOMQ4wDAYDVQQKDAVO
UkNBQzEPMA0GA1UEAwwGUk9PVENBMFkwEwYHKoZIzj0CAQYIKoEcz1UBgi0DQgAE
MPCca6pmgcchsTf2UnBeL9rtp4nw+itk1Kzrmbnqo05lUwkwlWK+4OIrtFdAqnRT
V7Q9v1htkv42TsIutzd126NdMFswHwYDVR0jBBgwFoAUTDKxl9kzG8SmBcHG5Yti
W/CXdlgwDAYDVR0TBAUwAwEB/zALBgNVHQ8EBAMCAQYwHQYDVR0OBBYEFEwysZfZ
MxvEpgXBxuWLYlvwl3ZYMAwGCCqBHM9VAYN1BQADSAAwRQIgG1bSLeOXp3oB8H7b
53W+CKOPl2PknmWEq/lMhtn25HkCIQDaHDgWxWFtnCrBjH16/W3Ezn7/U/Vjo5xI
pDoiVhsLwg==
-----END CERTIFICATE-----

-----BEGIN CERTIFICATE-----
MIIF0zCCA7ugAwIBAgIIH8+hjWpIDREwDQYJKoZIhvcNAQELBQAwejELMAkGA1UE
BhMCQ04xFjAUBgNVBAoMDUFudCBGaW5hbmNpYWwxIDAeBgNVBAsMF0NlcnRpZmlj
YXRpb24gQXV0aG9yaXR5MTEwLwYDVQQDDChBbnQgRmluYW5jaWFsIENlcnRpZmlj
YXRpb24gQXV0aG9yaXR5IFIxMB4XDTE4MDMyMTEzNDg0MFoXDTM4MDIyODEzNDg0
MFowejELMAkGA1UEBhMCQ04xFjAUBgNVBAoMDUFudCBGaW5hbmNpYWwxIDAeBgNV
BAsMF0NlcnRpZmljYXRpb24gQXV0aG9yaXR5MTEwLwYDVQQDDChBbnQgRmluYW5j
aWFsIENlcnRpZmljYXRpb24gQXV0aG9yaXR5IFIxMIICIjANBgkqhkiG9w0BAQEF
AAOCAg8AMIICCgKCAgEAtytTRcBNuur5h8xuxnlKJetT65cHGemGi8oD+beHFPTk
rUTlFt9Xn7fAVGo6QSsPb9uGLpUFGEdGmbsQ2q9cV4P89qkH04VzIPwT7AywJdt2
xAvMs+MgHFJzOYfL1QkdOOVO7NwKxH8IvlQgFabWomWk2Ei9WfUyxFjVO1LVh0Bp
dRBeWLMkdudx0tl3+21t1apnReFNQ5nfX29xeSxIhesaMHDZFViO/DXDNW2BcTs6
vSWKyJ4YIIIzStumD8K1xMsoaZBMDxg4itjWFaKRgNuPiIn4kjDY3kC66Sl/6yTl
YUz8AybbEsICZzssdZh7jcNb1VRfk79lgAprm/Ktl+mgrU1gaMGP1OE25JCbqli1
Pbw/BpPynyP9+XulE+2mxFwTYhKAwpDIDKuYsFUXuo8t261pCovI1CXFzAQM2w7H
DtA2nOXSW6q0jGDJ5+WauH+K8ZSvA6x4sFo4u0KNCx0ROTBpLif6GTngqo3sj+98
SZiMNLFMQoQkjkdN5Q5g9N6CFZPVZ6QpO0JcIc7S1le/g9z5iBKnifrKxy0TQjtG
PsDwc8ubPnRm/F82RReCoyNyx63indpgFfhN7+KxUIQ9cOwwTvemmor0A+ZQamRe
9LMuiEfEaWUDK+6O0Gl8lO571uI5onYdN1VIgOmwFbe+D8TcuzVjIZ/zvHrAGUcC
AwEAAaNdMFswCwYDVR0PBAQDAgEGMAwGA1UdEwQFMAMBAf8wHQYDVR0OBBYEFF90
tATATwda6uWx2yKjh0GynOEBMB8GA1UdIwQYMBaAFF90tATATwda6uWx2yKjh0Gy
nOEBMA0GCSqGSIb3DQEBCwUAA4ICAQCVYaOtqOLIpsrEikE5lb+UARNSFJg6tpkf
tJ2U8QF/DejemEHx5IClQu6ajxjtu0Aie4/3UnIXop8nH/Q57l+Wyt9T7N2WPiNq
JSlYKYbJpPF8LXbuKYG3BTFTdOVFIeRe2NUyYh/xs6bXGr4WKTXb3qBmzR02FSy3
IODQw5Q6zpXj8prYqFHYsOvGCEc1CwJaSaYwRhTkFedJUxiyhyB5GQwoFfExCVHW
05ZFCAVYFldCJvUzfzrWubN6wX0DD2dwultgmldOn/W/n8at52mpPNvIdbZb2F41
T0YZeoWnCJrYXjq/32oc1cmifIHqySnyMnavi75DxPCdZsCOpSAT4j4lAQRGsfgI
kkLPGQieMfNNkMCKh7qjwdXAVtdqhf0RVtFILH3OyEodlk1HYXqX5iE5wlaKzDop
PKwf2Q3BErq1xChYGGVS+dEvyXc/2nIBlt7uLWKp4XFjqekKbaGaLJdjYP5b2s7N
1dM0MXQ/f8XoXKBkJNzEiM3hfsU6DOREgMc1DIsFKxfuMwX3EkVQM1If8ghb6x5Y
jXayv+NLbidOSzk4vl5QwngO/JYFMkoc6i9LNwEaEtR9PhnrdubxmrtM+RjfBm02
77q3dSWFESFQ4QxYWew4pHE0DpWbWy/iMIKQ6UZ5RLvB8GEcgt8ON7BBJeMc+Dyi
kT9qhqn+lw==
-----END CERTIFICATE-----

-----BEGIN CERTIFICATE-----
MIICiDCCAgygAwIBAgIIQX76UsB/30owDAYIKoZIzj0EAwMFADB6MQswCQYDVQQG
EwJDTjEWMBQGA1UECgwNQW50IEZpbmFuY2lhbDEgMB4GA1UECwwXQ2VydGlmaWNh
dGlvbiBBdXRob3JpdHkxMTAvBgNVBAMMKEFudCBGaW5hbmNpYWwgQ2VydGlmaWNh
dGlvbiBBdXRob3JpdHkgRTEwHhcNMTkwNDI4MTYyMDQ0WhcNNDkwNDIwMTYyMDQ0
WjB6MQswCQYDVQQGEwJDTjEWMBQGA1UECgwNQW50IEZpbmFuY2lhbDEgMB4GA1UE
CwwXQ2VydGlmaWNhdGlvbiBBdXRob3JpdHkxMTAvBgNVBAMMKEFudCBGaW5hbmNp
YWwgQ2VydGlmaWNhdGlvbiBBdXRob3JpdHkgRTEwdjAQBgcqhkjOPQIBBgUrgQQA
IgNiAASCCRa94QI0vR5Up9Yr9HEupz6hSoyjySYqo7v837KnmjveUIUNiuC9pWAU
WP3jwLX3HkzeiNdeg22a0IZPoSUCpasufiLAnfXh6NInLiWBrjLJXDSGaY7vaokt
rpZvAdmjXTBbMAsGA1UdDwQEAwIBBjAMBgNVHRMEBTADAQH/MB0GA1UdDgQWBBRZ
4ZTgDpksHL2qcpkFkxD2zVd16TAfBgNVHSMEGDAWgBRZ4ZTgDpksHL2qcpkFkxD2
zVd16TAMBggqhkjOPQQDAwUAA2gAMGUCMQD4IoqT2hTUn0jt7oXLdMJ8q4vLp6sg
wHfPiOr9gxreb+e6Oidwd2LDnC4OUqCWiF8CMAzwKs4SnDJYcMLf2vpkbuVE4dTH
Rglz+HGcTLWsFs4KxLsq7MuU+vJTBUeDJeDjdA==
-----END CERTIFICATE-----

-----BEGIN CERTIFICATE-----
MIIDxTCCAq2gAwIBAgIUEMdk6dVgOEIS2cCP0Q43P90Ps5YwDQYJKoZIhvcNAQEF
BQAwajELMAkGA1UEBhMCQ04xEzARBgNVBAoMCmlUcnVzQ2hpbmExHDAaBgNVBAsM
E0NoaW5hIFRydXN0IE5ldHdvcmsxKDAmBgNVBAMMH2lUcnVzQ2hpbmEgQ2xhc3Mg
MiBSb290IENBIC0gRzMwHhcNMTMwNDE4MDkzNjU2WhcNMzMwNDE4MDkzNjU2WjBq
MQswCQYDVQQGEwJDTjETMBEGA1UECgwKaVRydXNDaGluYTEcMBoGA1UECwwTQ2hp
bmEgVHJ1c3QgTmV0d29yazEoMCYGA1UEAwwfaVRydXNDaGluYSBDbGFzcyAyIFJv
b3QgQ0EgLSBHMzCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAOPPShpV
nJbMqqCw6Bz1kehnoPst9pkr0V9idOwU2oyS47/HjJXk9Rd5a9xfwkPO88trUpz5
4GmmwspDXjVFu9L0eFaRuH3KMha1Ak01citbF7cQLJlS7XI+tpkTGHEY5pt3EsQg
wykfZl/A1jrnSkspMS997r2Gim54cwz+mTMgDRhZsKK/lbOeBPpWtcFizjXYCqhw
WktvQfZBYi6o4sHCshnOswi4yV1p+LuFcQ2ciYdWvULh1eZhLxHbGXyznYHi0dGN
z+I9H8aXxqAQfHVhbdHNzi77hCxFjOy+hHrGsyzjrd2swVQ2iUWP8BfEQqGLqM1g
KgWKYfcTGdbPB1MCAwEAAaNjMGEwHQYDVR0OBBYEFG/oAMxTVe7y0+408CTAK8hA
uTyRMB8GA1UdIwQYMBaAFG/oAMxTVe7y0+408CTAK8hAuTyRMA8GA1UdEwEB/wQF
MAMBAf8wDgYDVR0PAQH/BAQDAgEGMA0GCSqGSIb3DQEBBQUAA4IBAQBLnUTfW7hp
emMbuUGCk7RBswzOT83bDM6824EkUnf+X0iKS95SUNGeeSWK2o/3ALJo5hi7GZr3
U8eLaWAcYizfO99UXMRBPw5PRR+gXGEronGUugLpxsjuynoLQu8GQAeysSXKbN1I
UugDo9u8igJORYA+5ms0s5sCUySqbQ2R5z/GoceyI9LdxIVa1RjVX8pYOj8JFwtn
DJN3ftSFvNMYwRuILKuqUYSHc2GPYiHVflDh5nDymCMOQFcFG3WsEuB+EYQPFgIU
1DHmdZcz7Llx8UOZXX2JupWCYzK1XhJb+r4hK5ncf/w8qGtYlmyJpxk3hr1TfUJX
Yf4Zr0fJsGuv
-----END CERTIFICATE-----',

        //todo 公钥证书方式 支付宝公钥证书
        'alipayCertPath'     => '-----BEGIN CERTIFICATE-----
MIIDqDCCApCgAwIBAgIQICAFEo4SgMCQ5KzSRDmaYDANBgkqhkiG9w0BAQsFADCBkTELMAkGA1UE
BhMCQ04xGzAZBgNVBAoMEkFudCBGaW5hbmNpYWwgdGVzdDElMCMGA1UECwwcQ2VydGlmaWNhdGlv
biBBdXRob3JpdHkgdGVzdDE+MDwGA1UEAww1QW50IEZpbmFuY2lhbCBDZXJ0aWZpY2F0aW9uIEF1
dGhvcml0eSBDbGFzcyAyIFIxIHRlc3QwHhcNMjAwNTEyMDk0MjUwWhcNMjMwNTExMDk0MjUwWjB6
MQswCQYDVQQGEwJDTjEVMBMGA1UECgwM5rKZ566x546v5aKDMQ8wDQYDVQQLDAZBbGlwYXkxQzBB
BgNVBAMMOuaUr+S7mOWunSjkuK3lm70p572R57uc5oqA5pyv5pyJ6ZmQ5YWs5Y+4LTIwODgxMDIx
ODAxMjAxMDAwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQCS3s52NWZ7pCSaQXwcwpeB
y8HaTakKwhzf09Gom9AKCVKJOrpfBG/9cH1ytWZG3FRgeFyPBy0KMZUsPI4WQE2ySp4nxa2qj51w
UuaM6MLwASApXFLd6IPH3EkEjwQ+ug1FR3O+LXIrZaMAzlVydtDcqrjtvbW1qazoGgTPR/6Or82a
wVc0vl7znWxoKu19APecpjdAx1Q9QfyTgtbdCAQ70hx/iu999Tld2CWMyoXEMsLUw2uD4iycXDCb
UViFoNnYqRc172Chj7Ma396gnGFBu9LP4YHhJ7mZczrLLbR6bDCtZ5YNfJGxTc4kapAsOUJori9K
O+fWXm6gtXV0iLNLAgMBAAGjEjAQMA4GA1UdDwEB/wQEAwIE8DANBgkqhkiG9w0BAQsFAAOCAQEA
G/KINm5LdnlD71bt1w29KENNiu9ioTe4SNksu9oLeBhF5KlExs9g5dIuko+GpoUF06PuIhVVerHS
gQrTmRTsJWl7xv734TRpC64gJgtftNFEtkoTfFm+7u+NtRiT30aNGlzCVa/UyNdp8cE0Z9A/c8xA
f+rLX0hl8UcnmptDQiBjowfOJ8PnRWYqIC5r4ThjOhzSe2E5xDSfPv2mZKtdjyB4IZ0K93e4oCQf
QhqZBV6ZsKR0e16Nq/LD4xK1Tvw58341/mWWuTp5DESxgdtM1xktw3RTRtecICd217zTWPM4Kgua
CsVd9LeMqOhhvdTJFMzqCNbDw0zlQRCbGxJQmQ==
-----END CERTIFICATE-----
-----BEGIN CERTIFICATE-----
MIIE4jCCAsqgAwIBAgIIddq/0OOwJzIwDQYJKoZIhvcNAQELBQAwejELMAkGA1UEBhMCQ04xFjAU
BgNVBAoMDUFudCBGaW5hbmNpYWwxIDAeBgNVBAsMF0NlcnRpZmljYXRpb24gQXV0aG9yaXR5MTEw
LwYDVQQDDChBbnQgRmluYW5jaWFsIENlcnRpZmljYXRpb24gQXV0aG9yaXR5IFIxMB4XDTE4MDMy
MjE0MzAzMVoXDTM3MTEyNjE0MzAzMVowgYIxCzAJBgNVBAYTAkNOMRYwFAYDVQQKDA1BbnQgRmlu
YW5jaWFsMSAwHgYDVQQLDBdDZXJ0aWZpY2F0aW9uIEF1dGhvcml0eTE5MDcGA1UEAwwwQW50IEZp
bmFuY2lhbCBDZXJ0aWZpY2F0aW9uIEF1dGhvcml0eSBDbGFzcyAxIFIxMIIBIjANBgkqhkiG9w0B
AQEFAAOCAQ8AMIIBCgKCAQEA3OruCD7d4evJiEKxzJQYmwp5ziF7lT4fMpBb+WLme42Ulrkh4cJC
DEOTUL29Yb8NyQ6cRe9UHLupI2HbByDZoSJl7nkxyi5NGJLaADC7wnFBJq39WMaVBzouFo0yQkkY
NbbkJm+MsV4obu3l2xFGQx72bz6ThDJLpfYJbnGXqC4Bcyn8ubj1ddrJ0VsGdj/3Knmuo7XWLYqq
N/qomK3LJIpfhVozi0b2FWQl+lE9urch+FVhXSg0AlRGn8FTOVNlKrY+hAKZGZhqC+J+BD4GL3hQ
ZzVeNl0tMmSGz474lnt7DExNq33WfyJkn5UIoCfg8Tno7XTnocmBzbNYPq1aSQIDAQABo2MwYTAf
BgNVHSMEGDAWgBRfdLQEwE8HWurlsdsio4dBspzhATAdBgNVHQ4EFgQUcQfiBGEW5OXyZesxD8ng
9Dya1ZEwDwYDVR0TAQH/BAUwAwEB/zAOBgNVHQ8BAf8EBAMCAQYwDQYJKoZIhvcNAQELBQADggIB
AGkc6bDB4YQCa5D6IbgRtLfiqTQb5DeCp38uVKKrUl8ZCE5U+wXSu/fFhOkIs+Aq9tEOdPWgi7TA
xPMMbfJRTAF20qK1qF/X6lwRYGSi7LBbEhmI7dYFKj7i7z6fupBMVaI4C4O8KJGfovp3qD/FkXyb
13Lo8vL85Ll0BFk89Qbim0qYhW2JRsf9G46vBeIZaoMm8iMv9vvlVgMs30R96W+gZBgvlIE4ah+o
OEUd+G/V74vTbaXtWI8gkmwCzs/yUGW2g2ERHqZ3ksq4xwL+mNmqRNzq3aC9iA4p0uoHp/els89v
WHCUaPjHmEnhx+M843/WVjN8LWpoeQ+wc7Wz1jfYy0e+JXidqWkPn7qorlEQTfzcFBZh+YHnV6oV
tcG5iYatRKVTAPA+RrjJnEEzn6hAIPsiYsLmdA18f6ruuUUuKRukAEbCQ9q9L1gyOkaz2LxZj5kO
FyemDa3pjqESuHuazztnOvs6u4YrH03CPyK3G/6MhCNEJTxGDYy+8bRtNsTGRUbdmhZm/u8tjYIr
eNEy55f4WYlb72R6PODBLXmf4HWWPpyX1Zy9TEhmFsuPfelhBrdmBVM1iTwVFLW7gLqoEwzYhMt5
KRPjmfCc2P2pcbpLnYNcbSYiykFsCa7jHG0137Jv8Z/QH2N9r4+xdER7SW40ndmD59ynmGvrWUMj
-----END CERTIFICATE-----
',
        //商户RSA私钥 todo新版必传 todo 公钥证书方式
        'merchantPrivateKey' => 'MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCTR6TVMxHyTQmx4ugsFR9pUhPOLSKZ8c1XWdC0dfMIpMVvXY8/5r8CRFy9LFVE4oHV0suJOg5TNM8h8wvomKrntG+qG9bgPvAzaGpGb79YhrfINO1o0HkGn5qPDTJHp5lL0isSlJJf26BSKIy9KvI+CbNeiuAVLpqoVu0VSdHoghA7K9PwevT1S23ZM5SBw8IFeiSGdiu/l2FVkCWbYDjbbZat3Y5r2iQnc+E9dS5PN2BZtau0HeQntzLHgbZC/CFsbGCJsZ5PEACFVjhDlrx8yz5WAebqn2+/0Ext1SJTz/7LxOQyJAaI4HD+9oszYaT6cd9JmdSTYngyn5zMC7XTAgMBAAECggEAbA0m2CeEpiBw2WogbZ79kZZe42dnuEuXG9vP62WRbSj9lIuuefI+9lnTNBKfaE9Jc+cX3lCSi+b1g/G9LeM7l4xgVAvipFhofz6+oXiAiGEl2iNCfiBcekiD6ymCVuGV7PN/GD2Z+eu2fjAzuOEWIf+Z8eWvKrsrSg+kFnc3If2UzqvqavBULxkwqMa8gJvLi+aG6WtEqtgpZacBRPgQz3pbH+180wURKiJa4Fc1pcyskFlU7OCVf4YuANoEKdwbx9u6oKhw2J0FShqlmZ2hRrWlBR7BdIowM4ATs1o+HvJL38bX16RFOTKurJEiBnH6hIgq/HEqvwXPCvsi9crgaQKBgQDLuCmSHz7bsSTO3fQu2MGhASeW2kgYZGe8FBoyYOFi2ry+vVr25Kyxiu26yPf96PvOoG6bvuUKq1obHtidSBRCsJB8rYdLsF9EZozrVCi7fYhivysvd5qRRkCypHbDdXoUhE+bitIwYyx86AY0fI13g8r6snzy/YAq1vesKhM9HwKBgQC5E4zlt68/axCFXGCsPOgPZRjx6LeEk+8WJhuAIHqZVC+0HEXj7KZIZh9U6AFwzBtoggGOjGo1p68rdb0FbgRHAYvv5BfJNtGAW+518oQ/5aw6YppNsLABcQZHheuLDIcFx2zPOVLHlogeaVmhQIF8PsIy4a9Q1Ndp3Z9WDR+8zQKBgH1WG/Vz1deSgEPqGK6t20t0i2freknPlGcJsyhlpKWOUGvF0m5uOLWu9R5jQPht3Ga/G+4kn4RV8kUXUExMKXLycKLUnJX7uFE8Ct1KVRktXbjrRuWYX3eb0nhWaV9OKsLuuI/I9BKjIZ7jndWy/9KVOk/NesSBJNa2lYDODjIfAoGAaKHH51s4ZXcnCO5X7Sgl3gY+2wzBK9/irDfxFjfGeAbjTUUqshfpTkcF8Z+UqOuLl0LglHGH3julycEvkvFG08npDj96vxQRzyqqHt5zrBgxjXSPXdrFNptqfGcW6i6z6y16s5Dp3tKYs/DFbmekjNSCP/fdgKpD+qMD4MdcqQUCgYAipxz0EH+1CqszZmxG/bjp2ZqKPknKihKh4zaZ2vqIsnr38m877Qnp/Jx0VBE9p5Vi0A3Scbq6ml6XJqElLYJ2SqLMlSFlP/PVJ28xApvxoFXOojGGZDZ39D0jBEnp6+0StFLBSS/REEx7fo38Pkyal9p6CI/yrSYPnDCE09+HzA==',

        // 可以填写文件路径，或者密钥字符串  当前字符串是 rsa2 的支付宝公钥(开放平台获取) todo 普通公钥方式
        'ali_public_key'     => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmBjJu2eA5HVSeHb7jZsuKKbPp3w0sKEsLTVvBKQOtyb7bjQRWMWBI7FrcwEekM1nIL+rDv71uFtgv7apMMJdQQyF7g6Lnn9niG8bT1ttB8Fp0eud5L97eRjFTOa9NhxUVFjGDqQ3b88o6u20HNJ3PRckZhNaFJJQzlahCpxaiIRX2umAWFkaeQu1fcjmoS3l3BLj8Ly2zRZAnczv8Jnkp7qsVYeYt01EPsAxd6dRZRw3uqsv9pxSvyEYA7GV7XL6da+JdvXECalQeyvUFzn9u1K5ivGID7LPUakdTBUDzlYIhbpU1VS8xO1BU3GYXkAaumdWQt7f+khoFoSw+x8yqQIDAQAB',
        // 可以填写文件路径，或者密钥字符串  我的沙箱模式，rsa与rsa2的私钥相同，为了方便测试 todo 普通公钥方式
        'rsa_private_key'    => 'MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQC/z+Ue/oS0GjO2
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
        'use_sandbox'     => true,// 是否使用 招商测试系统
        'branch_no'       => 'xxx',  // 商户分行号，4位数字
        'merchant_no'     => 'xxxx',// 商户号，6位数字
        'mer_key'         => 'xxxxxx',// 秘钥16位，包含大小写字母 数字
        // 招商的公钥，建议每天凌晨2:15发起查询招行公钥请求更新公钥。
        'cmb_pub_key'     => 'xxxxx',
        'op_pwd'          => 'xxxxx',// 操作员登录密码。
        'sign_type'       => 'SHA-256',// 签名算法,固定为“SHA-256”
        'limit_pay'       => [
            //'A',
        ],// 允许支付的卡类型,默认对支付卡种不做限制，储蓄卡和信用卡均可支付   A:储蓄卡支付，即禁止信用卡支付
        'notify_url'      => 'http://114.215.86.31/__readme/phpinfo.php',// 支付成功的回调
        'sign_notify_url' => 'http://114.215.86.31/__readme/phpinfo.php',// 成功签约结果通知地址
        'return_url'      => 'https://wap.demo.com/',// 如果是h5支付，可以设置该值，返回到指定页面
        'return_raw'      => false,// 在处理回调时，是否直接返回原始数据，默认为true
    ];

}