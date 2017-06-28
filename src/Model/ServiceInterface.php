<?php

namespace johnluxor\QiwiPayment\Model;

use johnluxor\QiwiPayment\Exception\ForbiddenIpException;
use johnluxor\QiwiPayment\Model\Request\RequestInterface;

/**
 * Service Interface
 */
interface ServiceInterface
{
    /**
     * @param array $validIps
     * @param array $commandClassNames
     */
    public function __construct(array $validIps, array $commandClassNames);

    /**
     * @param array $params get parameters
     *
     * @return RequestInterface
     *
     * @throws ForbiddenIpException|\BadMethodCallException
     */
    public function handleRequest(array $params);

    /**
     * @param array $validIps
     */
    public function setValidIps(array $validIps);

    /**
     * @return array
     */
    public function getValidIps();

    /**
     * @param string $command Command name
     *
     * @return RequestInterface
     */
    public function getCommandClassName($command);

    /**
     * @return string
     */
    public function getRequestIp();
}