<?php

namespace Payment\Client;

use Payment\Common\PayException;
use Payment\Config;
use Payment\Notify\PayNotifyInterface;
use Payment\NotifyContext;

/**
 * Class Notify
 * @package Payment\Client
 */
class Notify
{
    /** @var array */
    private static $supportChannel = [
        Config::ALI_CHARGE,// 支付宝
        Config::WX_CHARGE,// 微信
        Config::CMB_CHARGE,// 招行一网通
    ];

    /**
     * 异步通知类
     * @var NotifyContext
     */
    protected static $instance;

    /**
     * 获取实例
     * @param $type
     * @param $config
     * @return NotifyContext
     * @throws PayException
     */
    protected static function getInstance($type, $config)
    {
        /* 设置内部字符编码为 UTF-8 */
        mb_internal_encoding("UTF-8");
        if (is_null(self::$instance)) {
            static::$instance = new NotifyContext();
        }
        try {
            static::$instance->initNotify($type, $config);
        } catch (PayException $e) {
            throw $e;
        }
        return static::$instance;
    }

    /**
     * 执行异步工作,内部进行了签名检查
     *
     * @param string $type
     * @param array $config
     * @param PayNotifyInterface $callback
     * @return string 支付宝/微信支付成功或失败字符串,例如success,fail或者xml字符串
     * @throws PayException
     */
    public static function run($type, $config, $callback)
    {
        if (!in_array($type, self::$supportChannel)) {
            throw new PayException('sdk当前不支持该异步方式，当前仅支持：' . implode(',', self::$supportChannel));
        }
        try {
            $instance = self::getInstance($type, $config);
            $ret      = $instance->notify($callback);
        } catch (PayException $e) {
            throw $e;
        }
        return $ret;
    }

    /**
     * 返回异步通知的结果,获取第三方的原始数据，未进行签名检查
     *
     * @param $type
     * @param $config
     * @return array|false
     * @throws PayException
     */
    public static function getNotifyData($type, $config)
    {
        try {
            $instance = self::getInstance($type, $config);
            return $instance->getNotifyData();
        } catch (PayException $e) {
            throw $e;
        }
    }
}
