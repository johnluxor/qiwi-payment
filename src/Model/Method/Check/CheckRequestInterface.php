<?php

namespace johnluxor\QiwiPayment\Model\Method\Check;

use johnluxor\QiwiPayment\Model\Request\RequestInterface;

/**
 * Subscribers’ Account Status Check and Payment Registration Request Interface
 */
interface CheckRequestInterface extends RequestInterface
{
    /**
     * Internal logic processing
     *
     * @return CheckResponseInterface
     */
    public function process();
}
