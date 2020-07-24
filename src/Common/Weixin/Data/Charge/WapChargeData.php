<?php

namespace Payment\Common\Weixin\Data\Charge;

use Payment\Common\PayException;
use Payment\Utils\ArrayUtil;

/**
 * 构建wap支付的下单数据
 * Class WapChargeData
 *
 * @property string $openid  trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识
 * @property string $sub_openid 用户在子商户appid下的唯一标识
 *
 * @package Payment\Common\Weixin\Data\Charge
 */
class WapChargeData extends ChargeBaseData
{
    protected function checkDataParam()
    {
        parent::checkDataParam();
        $info = $this->scene_info;
        if (!is_array($info) || empty($info)) {
            throw new PayException('微信 H5 支付，必须提供该参数');
        }
    }

    protected function buildData()
    {
        $info      = $this->scene_info;
        $sceneInfo = [];
        if ($info && is_array($info)) {
            $sceneInfo['h5_info'] = $info;
        }

        $signData = [
            'appid'            => trim($this->appId),
            'mch_id'           => trim($this->mchId),
            'device_info'      => $this->terminal_id,
            'nonce_str'        => $this->nonceStr,
            'sign_type'        => $this->signType,
            'body'             => trim($this->subject),
            //'detail' => json_encode($this->body, JSON_UNESCAPED_UNICODE),
            'attach'           => trim($this->return_param),
            'out_trade_no'     => trim($this->order_no),
            'fee_type'         => $this->feeType,
            'total_fee'        => $this->amount,
            'spbill_create_ip' => trim($this->client_ip),
            'time_start'       => $this->timeStart,
            'time_expire'      => $this->timeout_express,
            //'goods_tag' => '订单优惠标记',
            'notify_url'       => $this->notifyUrl,
            'trade_type'       => $this->tradeType, //设置APP支付
            //'product_id' => '商品id',
            'limit_pay'        => $this->limitPay,  // 指定不使用信用卡
            'openid'           => $this->openid,
            'scene_info'       => $sceneInfo ? json_encode($sceneInfo, JSON_UNESCAPED_UNICODE) : '',

            // 服务商
            'sub_appid'        => $this->sub_appid,
            'sub_mch_id'       => $this->sub_mch_id,
            'sub_openid'       => $this->sub_openid,
        ];

        // 移除数组中的空值
        $this->retData = ArrayUtil::paraFilter($signData);
    }
}
