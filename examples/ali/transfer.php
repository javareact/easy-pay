<?php
/**
 * 支付转账操作
 * Created by PhpStorm.
 * User: Admin
 * Date: 2017/4/30
 * Time: 下午5:57
 */

require_once __DIR__ . '/../../vendor/autoload.php';

use Payment\Common\PayException;
use Payment\Client\Transfer;
use Payment\Config;

date_default_timezone_set('Asia/Shanghai');
$aliConfig = require_once __DIR__ . '/../aliconfig.php';


// todo 老接口
//$data = [
//    'trans_no'        => time(),
//    'payee_type'      => 'ALIPAY_LOGONID',
//    'payee_account'   => 'aaqlmq0729@sandbox.com',// ALIPAY_USERID: 2088102169940354      ALIPAY_LOGONID：aaqlmq0729@sandbox.com
//    'amount'          => '1000',
//    'remark'          => '转账拉，有钱了',
//    'payer_show_name' => '一个未来的富豪',
//];

// todo 新接口
$data = [
    'trans_no'     => time(),
    'trans_amount' => 0.01,
    'remark'       => '转账拉，有钱了',
    'product_code' => 'TRANS_ACCOUNT_NO_PWD',
    'payee_info'   => [
        'identity'      => '2088102169940354',// ALIPAY_USERID: 2088102169940354      ALIPAY_LOGONID：aaqlmq0729@sandbox.com
        'identity_type' => 'ALIPAY_USER_ID',
        'name'          => '张三',
    ],
    'payer_info'   => [
        'identity'      => 'tmixpo1440@sandbox.com',// ALIPAY_USERID: 2088102169940354      ALIPAY_LOGONID：aaqlmq0729@sandbox.com
        'identity_type' => 'ALIPAY_LOGONID',
        'name'          => '王五',
    ],
    'biz_scene'    => 'DIRECT_TRANSFER'
];

try {
    $ret = Transfer::run(Config::ALI_TRANSFER, $aliConfig, $data);
} catch (PayException $e) {
    echo $e->errorMessage();
    exit;
}
echo json_encode($ret, JSON_UNESCAPED_UNICODE);
