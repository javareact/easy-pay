<?php

namespace Test\EasyPay;

use Payment\Client\Charge;
use Payment\Common\PayException;
use Payment\Config;

/**
 * 微信测试
 * @internal
 */
class WxTest extends BaseTest
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testIndex()
    {

    }

    /**
     * 小程序支付
     * @test
     */
    public function testXcxPay()
    {
        $orderNo = time() . rand(1000, 9999);
// 订单信息
        $payData = [
            'body'            => 'test body',
            'subject'         => 'test subject',
            'order_no'        => $orderNo,
            'timeout_express' => time() + 600,// 表示必须 600s 内付款
            'amount'          => '3.01',// 微信沙箱模式，需要金额固定为3.01
            'return_param'    => '123',
            'client_ip'       => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1',// 客户地址
            'openid'          => 'ottkCuO1PW1Dnh6PWFffNk-2MPbY',
            'product_id'      => '123',
        ];

        try {
            $ret = Charge::run(Config::WX_CHANNEL_LITE, Contains::WX_CONFIG, $payData);
        } catch (PayException $e) {
            echo $e->errorMessage();
            exit;
        }
        echo json_encode($ret, JSON_UNESCAPED_UNICODE);

    }
}