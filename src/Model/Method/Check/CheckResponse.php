<?php

namespace johnluxor\QiwiPayment\Model\Method\Check;

use johnluxor\QiwiPayment\Model\Response\AbstractResponse;
use LaLit\Array2XML;

/**
 * Subscribers’ Account Status Check and Payment Registration Response
 */
class CheckResponse extends AbstractResponse implements CheckResponseInterface
{
    /**
     * @return string
     */
    public function xml()
    {
        $response = [
            'osmp_txn_id' => $this->getOsmpTxnId(),
            'result' => $this->getResult(),
            'comment' => $this->getComment(),
        ];

        return Array2XML::createXML('response', $response)->saveXML();
    }
}
