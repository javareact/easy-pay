# EasyPay

## 支付宝/微信支付 一行接入

```
try {
    $str = Charge::run(支付类型, 配置文件, 支付数据);
} catch (PayException $e) {
    echo $e->errorMessage();
    exit;
}
```