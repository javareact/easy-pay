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
            'trans_no'     => time(),
            'trans_amount' => 0.1,
            'remark'       => '转账拉，有钱了',
            'product_code' => 'TRANS_ACCOUNT_NO_PWD',
            //            业务产品码，
            //收发现金红包固定为：STD_RED_PACKET；
            //单笔无密转账到支付宝账户固定为：TRANS_ACCOUNT_NO_PWD；
            //单笔无密转账到银行卡固定为：TRANS_BANKCARD_NO_PWD
            'payee_info'   => [
                'identity'      => '2088102169940354',//// ALIPAY_USERID: 2088102169940354      ALIPAY_LOGONID：aaqlmq0729@sandbox.com
                'identity_type' => 'ALIPAY_USER_ID',//参与方的标识类型，目前支持如下类型：1、ALIPAY_USER_ID 支付宝的会员ID,2、ALIPAY_LOGON_ID：支付宝登录号，支持邮箱和手机号格式
                //                'name'          => '张三',//参与方真实姓名，如果非空，将校验收款支付宝账号姓名一致性。当identity_type=ALIPAY_LOGON_ID时，本字段必填。
            ],
            'biz_scene'    => 'DIRECT_TRANSFER'//描述特定的业务场景，可传的参数如下：
            //PERSONAL_COLLECTION：C2C现金红包-领红包；
            //DIRECT_TRANSFER：B2C现金红包、单笔无密转账到支付宝/银行卡
        ];
        try {
            $ret = Transfer::run(Config::ALI_TRANSFER, Contains::ALI_CONFIG, $data);
        } catch (PayException $e) {
            var_export($e->errorMessage());
            exit;
        }
        var_export($ret);
        $this->assertSame('T', $ret['is_success']);
    }
}