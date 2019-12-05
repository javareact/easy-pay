<?php
namespace Payment\Common;

/**
 * @author: admin
 * @createTime: 2016-07-28 16:45
 * @description: 所有的策略类接口
 */
interface BaseStrategy
{
    /**
     * 处理具体的业务
     * @param array $data
     * @return mixed
     */
    public function handle(array $data);

    /**
     * 获取支付对应的数据完成类
     * @return BaseData
     */
    public function getBuildDataClass();
}
