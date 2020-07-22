<?php

namespace Payment;

use Payment\Common\BaseStrategy;
use Payment\Common\PayException;
use Payment\Trans\AliTransfer;
use Payment\Trans\WxTransfer;

/**
 * 转账上下文
 * Class TransferContext
 * @package Payment
 */
class TransferContext
{
    /**
     * 转款渠道
     * @var BaseStrategy
     */
    protected $transfer;

    /**
     * 设置对应的退款渠道
     * @param string $channel 退款渠道
     *  - @param array $config 配置文件
     * @throws PayException
     * @see Config
     *
     */
    public function initTransfer($channel, array $config)
    {
        try {
            switch ($channel) {
                case Config::ALI_TRANSFER:
                    $this->transfer = new AliTransfer($config);
                    break;
                case Config::WX_TRANSFER:
                    $this->transfer = new WxTransfer($config);
                    break;
                default:
                    throw new PayException('当前仅支持：ALI WEIXIN两个常量');
            }
        } catch (PayException $e) {
            throw $e;
        }
    }

    /**
     * 通过环境类调用支付转款操作
     *
     * @param array $data
     *
     * @return array
     * @throws PayException
     */
    public function transfer(array $data)
    {
        if (!$this->transfer instanceof BaseStrategy) {
            throw new PayException('请检查初始化是否正确');
        }
        //去掉特殊字符,防止签名错误
        array_walk_recursive($data, function (&$val) {
            if (is_string($val) && strpos($val, '+') !== false) {
                $val = str_replace('+', '', $val);
            }
        });
        try {
            return $this->transfer->handle($data);
        } catch (PayException $e) {
            throw $e;
        }
    }
}
