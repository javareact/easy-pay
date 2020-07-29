<?php

namespace Payment\Client;

use Payment\Common\PayException;
use Payment\Config;
use Payment\RefundContext;

/**
 * @author: admin
 * @description: 退款操作客户端接口
 *
 * Class Refund
 * @package Payment\Client
 */
class Refund
{
    private static $supportChannel = [
        Config::ALI_REFUND,// 支付宝

        Config::WX_REFUND,// 微信

        Config::CMB_REFUND,// 招行一网通

        'applepay_upacp',// Apple Pay
    ];

    /**
     * 退款实例
     * @var RefundContext
     */
    protected static $instance;

    /**
     * @param $channel
     * @param $config
     * @return RefundContext
     * @throws PayException
     */
    protected static function getInstance($channel, $config)
    {
        /* 设置内部字符编码为 UTF-8 */
        mb_internal_encoding("UTF-8");

        if (is_null(self::$instance)) {
            static::$instance = new RefundContext();
        }

        try {
            static::$instance->initRefund($channel, $config);
        } catch (PayException $e) {
            throw $e;
        }

        return static::$instance;
    }

    /**
     * @param $channel
     * @param $config
     * @param $refundData
     * @return array
     * @throws PayException
     */
    public static function run($channel, $config, $refundData)
    {
        if (!in_array($channel, self::$supportChannel)) {
            throw new PayException('sdk当前不支持该退款渠道，当前仅支持：' . implode(',', self::$supportChannel));
        }

        try {
            $instance = self::getInstance($channel, $config);

            $ret = $instance->refund($refundData);
        } catch (PayException $e) {
            throw $e;
        }

        return $ret;
    }
}
