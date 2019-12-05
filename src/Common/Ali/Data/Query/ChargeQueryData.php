<?php

namespace Payment\Common\Ali\Data\Query;

use Payment\Common\Ali\Data\AliBaseData;
use Payment\Common\PayException;
use Payment\Utils\ArrayUtil;

/**
 * 支付查询数据构造
 * Class ChargeQueryData
 *
 * @property string $trade_no 支付宝的订单号，优先使用
 * @property string $out_trade_no 商户系统内部的订单号
 *
 * @package Payment\Common\Ali\Data\Query
 * @anthor admin
 */
class ChargeQueryData extends AliBaseData
{
    /**
     * 构建业务数据
     * @return array
     */
    protected function getBizContent()
    {
        $content = [
            'out_trade_no' => $this->out_trade_no,
            'trade_no'     => $this->trade_no,
        ];

        return $content;
    }

    /**
     * 检查参数
     * @throws PayException
     */
    protected function checkDataParam()
    {
        $tradeNo    = $this->trade_no;// 支付宝交易号，查询效率高
        $outTradeNo = $this->out_trade_no;// 商户订单号，查询效率低，不建议使用

        // 二者不能同时为空
        if (empty($outTradeNo) && empty($tradeNo)) {
            throw new PayException('必须提供支付宝交易号或者商户网站唯一订单号。建议使用支付宝交易号');
        }
    }
}
