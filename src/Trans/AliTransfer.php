<?php

namespace Payment\Trans;

use Payment\Common\Ali\AliBaseStrategy;
use Payment\Common\Ali\Data\TransData;
use Payment\Common\PayException;
use Payment\Config;

/**
 * 支付宝转账操作
 * Class AliTransfer
 * @package Payment\Trans
 */
class AliTransfer extends AliBaseStrategy
{
    /** @var string 使用新版支付宝转账,单日额度100万 */
    protected $method = '';

    public function getBuildDataClass()
    {
        if ($this->config->certType == 1) {
            $this->method = 'alipay.fund.trans.uni.transfer';//新接口
        } else {
            $this->method = 'alipay.fund.trans.toaccount.transfer';//旧接口
        }
        $this->config->method = $this->method;
        return TransData::class;
    }

    /**
     * @param array $data
     * @return array|string
     * @throws PayException
     */
    protected function retData(array $data)
    {
        $reqData = parent::retData($data);

        try {
            $retData = $this->sendReq($reqData);
        } catch (PayException $e) {
            throw $e;
        }
        return $this->createBackData($retData);
    }

    /**
     * 处理返回的数据
     * @param array $data
     * @return array
     */
    protected function createBackData(array $data)
    {
        if ($this->config->returnRaw) {
            $data['channel'] = Config::ALI_TRANSFER;
            return $data;
        }

        if ($data['code'] !== '10000') {
            return $retData = [
                'is_success' => 'F',
                'error'      => $data['sub_msg'],
                'channel'    => Config::ALI_TRANSFER,
            ];
        }

        if ($this->config->certType == 1) {
            //公钥证书方式
            $pay_date = $data['trans_date'] ?? date('Y-m-d H:i:s');// 支付时间
        } else {
            //普通公钥方式
            $pay_date = $data['pay_date'] ?? date('Y-m-d H:i:s');
        }

        $retData = [
            'is_success' => 'T',
            'response'   => [
                'trans_no'       => $data['out_biz_no'],// 商户转账唯一订单号
                'transaction_id' => $data['order_id'],// 支付宝转账单据号
                'pay_date'       => $pay_date,// 支付时间
                'channel'        => Config::ALI_TRANSFER,
            ],
        ];

        return $retData;
    }
}
