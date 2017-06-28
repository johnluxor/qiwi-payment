<?php

namespace johnluxor\QiwiPayment;

use johnluxor\QiwiPayment\Model\Method\Pay\PayRequest;
use johnluxor\QiwiPayment\Model\Method\Pay\PayResponse;

class Pay extends PayRequest
{
    /**
     * Internal logic processing
     *
     * @return PayResponse
     */
    public function process()
    {
        /**
         * @var PayResponse $response
         */
        $response = $this->getResponse();

        return $response
            ->setOsmpTxnId($this->getTxnId())
            ->setPrvTxn(123)
            ->setSum($this->getSum())
            ->setResult(0)
            ->setComment('some pay comment');
    }
}