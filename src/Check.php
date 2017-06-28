<?php

namespace johnluxor\QiwiPayment;

use johnluxor\QiwiPayment\Model\Method\Check\CheckRequest;
use johnluxor\QiwiPayment\Model\Method\Check\CheckResponse;

class Check extends CheckRequest
{
    /**
     * Internal logic processing
     *
     * @return CheckResponse
     */
    public function process()
    {
        /**
         * @var CheckResponse $response
         */
        $response = $this->getResponse();

        return $response
            ->setOsmpTxnId($this->getTxnId())
            ->setResult(0)
            ->setComment('some Check comment');
    }
}
