<?php

namespace johnluxor\QiwiPayment\Model\Method\Pay;

use johnluxor\QiwiPayment\Model\Request\RequestInterface;

/**
 * Personal Account Refill Request Interface
 */
interface PayRequestInterface extends RequestInterface
{
    /**
     * @param int $txnDate
     *
     * @return $this
     */
    public function setTxnDate($txnDate);

    /**
     * @return int
     */
    public function getTxnDate();

    /**
     * Internal logic processing
     *
     * @return PayResponseInterface
     */
    public function process();
}
