<?php

namespace johnluxor\QiwiPayment\Model\Method\Check;

use johnluxor\QiwiPayment\Model\Request\AbstractRequest;

/**
 * Subscribers’ Account Status Check and Payment Registration Request
 */
abstract class CheckRequest extends AbstractRequest implements CheckRequestInterface
{
    /**
     * Get response object
     *
     * @return CheckResponseInterface
     */
    public function getResponse(): CheckResponseInterface
    {
        return new CheckResponse();
    }

    /**
     * @param array $params from $_GET parameters
     *
     * @return CheckRequestInterface
     */
    public function handleRequest(array $params): CheckRequestInterface
    {
        return $this
            ->setTxnId($params['txn_id'])
            ->setAccount($params['account'])
            ->setSum($params['sum']);
    }
}
