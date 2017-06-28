<?php

namespace johnluxor\QiwiPayment\Model\Method\Pay;

use johnluxor\QiwiPayment\Model\Response\AbstractResponse;
use LaLit\Array2XML;

/**
 * Personal Account Refill Response
 */
class PayResponse extends AbstractResponse implements PayResponseInterface
{
    /**
     * Subscribers’ balance update operation unique number (in providers base)
     *
     * @var int number up to 20 digits
     * @required
     */
    protected $prvTxn;

    /**
     * @param int $prvTxn
     *
     * @return $this
     */
    public function setPrvTxn($prvTxn)
    {
        $this->prvTxn = $prvTxn;

        return $this;
    }

    /**
     * @return int
     */
    public function getPrvTxn()
    {
        return $this->prvTxn;
    }

    /**
     * @return string
     */
    public function xml()
    {
        $response = [
            'osmp_txn_id' => $this->getOsmpTxnId(),
            'prv_txn' => $this->getPrvTxn(),
            'sum' => $this->getSum(),
            'result' => $this->getResult(),
            'comment' => $this->getComment()
        ];

        return Array2XML::createXML('response', $response)->saveXML();
    }
}
