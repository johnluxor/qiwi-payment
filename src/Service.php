<?php

namespace johnluxor\QiwiPayment;

use johnluxor\QiwiPayment\Exception\ForbiddenIpException;
use johnluxor\QiwiPayment\Model\Request\RequestInterface;
use johnluxor\QiwiPayment\Model\ServiceInterface;

/**
 * Service
 */
class Service implements ServiceInterface
{
    /**
     * An interface should accept HTTP or HTTPS requests from subnet IP-addresses
     *
     * @var array
     */
    protected $validIps = [

    ];

    /**
     * Command class names for internal logic processing
     * Need to implement Model\Method\XXX interface
     *
     * @example array(
     *      'check' => 'johnluxor\QiwiPayment\Model\Method\Check\CheckRequest',
     *      'pay'   => 'johnluxor\QiwiPayment\Model\Method\Pay\PayRequest',
     * )
     *
     * @var array
     */
    protected $commandClassNames = [];

    /**
     * @param array $validIps
     * @param array $commandClassNames
     */
    public function __construct(array $validIps, array $commandClassNames)
    {
        $this->validIps = $validIps;

        $this->commandClassNames = $commandClassNames;
    }

    /**
     * @param array $params get parameters
     *
     * @return RequestInterface
     *
     * @throws ForbiddenIpException|\BadMethodCallException
     */
    public function handleRequest(array $params)
    {
        if (!in_array($this->getRequestIp(), $this->getValidIps(), true)) {
            throw new ForbiddenIpException();
        }

        if (!isset($params['command'])) {
            throw new \BadMethodCallException('Undefined command parameter');
        }

        $class = $this->getCommandClassName($params['command']);

        return $class->handleRequest($params);
    }

    /**
     * @param array $validIps
     */
    public function setValidIps(array $validIps)
    {
        $this->validIps = $validIps;
    }

    /**
     * @return array
     */
    public function getValidIps(): array
    {
        return $this->validIps;
    }

    /**
     * @param string $command Command name
     *
     * @return RequestInterface
     * @throws \InvalidArgumentException
     */
    public function getCommandClassName($command)
    {
        if (!isset($this->commandClassNames[$command])) {
            throw new \InvalidArgumentException(sprintf('Attempted to load class for command QIWI command "%s"',
                $command));
        }

        $className = $this->commandClassNames[$command];

        if (!class_exists($className)) {
            throw new \InvalidArgumentException(sprintf('Attempted to load class "%s" for command QIWI command "%s"',
                $className, $command));
        }

        /**
         * @var RequestInterface $class
         */
        return new $className();
    }

    /**
     * @return string
     */
    public function getRequestIp()
    {
        return getenv('REMOTE_ADDR');
    }
}