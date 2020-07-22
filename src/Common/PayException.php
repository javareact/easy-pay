<?php

namespace Payment\Common;

/**
 * 支付异常
 * @package Payment\Common
 */
class PayException extends \Exception
{
    /**
     * 获取异常错误信息
     * @return string
     */
    public function errorMessage()
    {
        return $this->getMessage();
    }
}
