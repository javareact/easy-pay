<?php

namespace Payment;

use Payment\Common\BaseStrategy;
use Payment\Common\PayException;
use Payment\Red\AliRed;
use Payment\Red\WxRed;

/**
 * 红包操作
 * Class RedContext
 * @package Payment
 */
class RedContext
{
    /**
     * 发送渠道
     * @var BaseStrategy
     */
    protected $red;

    /**
     * 设置对应的发送渠道
     * @param string $channel 退款渠道
     *  - @param array $config 配置文件
     * @throws PayException
     * @see Config
     *
     * @author IT
     */
    public function initRed($channel, array $config)
    {
        try {
            switch ($channel) {
                case Config::ALI_RED:
                    $this->red = new AliRed($config);
                    break;
                case Config::WX_RED:
                    $this->red = new WxRed($config);
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
    public function red(array $data)
    {
        if (!$this->red instanceof BaseStrategy) {
            throw new PayException('请检查初始化是否正确');
        }
        //去掉特殊字符,防止签名错误
        array_walk_recursive($data, function (&$val) {
            if (is_string($val) && strpos($val, '+') !== false) {
                $val = str_replace('+', '', $val);
            }
        });
        try {
            return $this->red->handle($data);
        } catch (PayException $e) {
            throw $e;
        }
    }
}
