<?php

/**
 * Created by PhpStorm.
 * User: cjohnson
 * Date: 1/28/16
 * Time: 7:59 PM
 */
class PhilipsHueService
{
    private $bridgeHost;
    private $client;
    private $username;

    /**
     * PhilipsHueService constructor.
     *
     * @param $host
     * @param $client
     */
    public function __construct($host, $client)
    {
        $this->setBridgeHost($host);
        $this->setClient($client);
    }

    /**
     * @return mixed
     */
    public function getBridgeHost()
    {
        return $this->bridgeHost;
    }

    /**
     * @param mixed $bridgeHost
     */
    public function setBridgeHost($bridgeHost)
    {
        $this->bridgeHost = $bridgeHost;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return bool
     */
    public function canConnect()
    {
        try
        {
            (new \Phue\Command\Ping)->send($this->getClient());
        }
        catch (\Phue\Transport\Exception\ConnectionException $e)
        {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function isAuthenticated()
    {
        return $this->getClient()->sendCommand(new \Phue\Command\IsAuthorized);
    }

    /**
     * @return bool
     */
    public function createAuthUser()
    {
        try
        {
            $response = $this->getClient()->sendCommand(new \Phue\Command\CreateUser);

            $this->setUsername($response->username);

            return true;
        }
        catch (\Phue\Transport\Exception\LinkButtonException $e)
        {
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

}