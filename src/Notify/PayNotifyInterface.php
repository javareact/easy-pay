<?php

namespace Payment\Notify;

/**
 * 提供给客户端实现的 支付异步回调 接口
 * Interface PayNotifyInterface
 * @package Payment\Notify
 */
interface PayNotifyInterface
{
    /**
     * 异步回调检验完成后，回调客户端的业务逻辑，业务逻辑处理，必须实现该类，不建议抛出异常
     * @param array $data 返回的数据
     * @return bool 执行业务逻辑，成功后请返回true，失败后请返回false。
     */
    public function notifyProcess(array $data);
}
