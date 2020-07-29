<?php

namespace Payment\Charge\Wx;

use Payment\Common\Weixin\Data\Charge\BarChargeData;
use Payment\Common\Weixin\WxBaseStrategy;

/**
 * @author: admin
 * @description: 微信 刷卡支付  对应支付宝的条码支付
 */
class WxBarCharge extends WxBaseStrategy
{
    protected $reqUrl = 'https://api.mch.weixin.qq.com/{debug}/pay/micropay';

    public function getBuildDataClass()
    {
        return BarChargeData::class;
    }

    /**
     * 返回的数据
     * @param array $ret
     * @return array
     */
    protected function retData(array $ret)
    {
        $ret['total_fee'] = bcdiv($ret['total_fee'], 100, 2);
        $ret['cash_fee']  = bcdiv($ret['cash_fee'], 100, 2);
        if ($this->config->returnRaw) {
            return $ret;
        }
        return $ret;
    }
}
