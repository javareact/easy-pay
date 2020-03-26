<?php

namespace Test\EasyPay;

use Payment\Client\Transfer;
use Payment\Common\PayException;
use Payment\Config;

/**
 * 支付宝测试
 * @internal
 */
class AliTest extends BaseTest
{

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testTransfer()
    {
        $data = [
            'trans_no'        => time(),
            'payee_type'      => 'ALIPAY_LOGONID',
            'payee_account'   => 'aaqlmq0729@sandbox.com',// ALIPAY_USERID: 2088102169940354      ALIPAY_LOGONID：aaqlmq0729@sandbox.com
            'amount'          => '0.1',
            'remark'          => '转账拉，有钱了',
            'payer_show_name' => '一个未来的富豪',
        ];
        try {
            $ret = Transfer::run(Config::ALI_TRANSFER, Contains::ALI_CONFIG, $data);
        } catch (PayException $e) {
            echo $e->errorMessage();
            exit;
        }
        echo json_encode($ret, JSON_UNESCAPED_UNICODE);
    }
}