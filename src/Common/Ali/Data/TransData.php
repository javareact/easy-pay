<?php

namespace Payment\Common\Ali\Data;

use Payment\Common\PayException;
use Payment\Config;

/**
 * 转账到支付宝帐号
 * Class TransData
 *
 * @property string $trans_no  商户转账唯一订单号
 * @property string $payee_type  收款方账户类型。可取值： 1、ALIPAY_USERID：支付宝账号对应的支付宝唯一用户号。以2088开头的16位纯数字组成。 2、ALIPAY_LOGONID：支付宝登录号，支持邮箱和手机号格式。
 * @property string $payee_account 收款方账户。与payee_type配合使用。付款方和收款方不能是同一个账户。
 * @property string $trans_amount  转账金额，单位：元。 只支持2位小数，小数点前最大支持13位，金额必须大于0。
 *
 * // 可选参数
 * @property string $payer_real_name 付款方真实姓名
 * @property string $payee_real_name 收款方真实姓名
 * @property string $payer_show_name  默认显示该账户在支付宝登记的实名。收款方可见。
 * @property string $remark 转账备注  当付款方为企业账户，且转账金额达到（大于等于）50000元，remark不能为空
 *
 * @package Payment\Common\Ali\Data
 * @anthor admin
 */
class TransData extends AliBaseData
{
    /**
     * 检查参数是否合法
     * @throws PayException
     */
    protected function checkDataParam()
    {
        $transNo      = $this->trans_no;
        $payeeInfo    = $this->payee_info;
        $transAmount  = $this->trans_amount;
        $product_code = $this->product_code;
        $biz_scene    = $this->biz_scene;
        $remark       = $this->remark;

        if (empty($transNo)) {
            throw new PayException('请传入 商户转账唯一订单号');
        }

        if (empty($biz_scene)) {
            throw new PayException('请传入 业务场景');
        }

        if (empty($product_code)) {
            throw new PayException('请传入 业务产品码');
        }

        if (empty($payeeInfo)) {
            throw new PayException('请传入转账帐号');
        }

        if (empty($transAmount) || bccomp($transAmount, 0, 2) !== 1) {
            throw new PayException('请输入转账金额，且大于0');
        }

        if (bccomp($transAmount, Config::TRANS_FEE, 2) !== -1 && empty($remark)) {
            throw new PayException('转账金额大于等于' . Config::TRANS_FEE, '必须设置 remark');
        }
    }

    /**
     * 业务请求参数的集合，最大长度不限，除公共参数外所有请求参数都必须放在这个参数中传递
     *
     * @return string
     */
    protected function getBizContent()
    {
        $content = [
            'out_biz_no'   => $this->trans_no,// 商户转账唯一订单号
            'payee_type'   => strtoupper($this->payee_type),// 收款方账户类型
            'trans_amount' => $this->trans_amount,
            'payer_info'   => $this->payer_info,
            'payee_info'   => $this->payee_info,
            'product_code' => $this->product_code,
            'biz_scene'    => $this->biz_scene,
            'remark'       => $this->remark,
        ];
        return $content;
    }
}
