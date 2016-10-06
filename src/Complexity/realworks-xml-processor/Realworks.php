<?php

namespace RealworksXmlProcessor;

use RealworksXmlProcessor\Http\Fetcher;

class Realworks
{
    const REALWORKS_ENDPOINT    = "https://roemerbakker.com/tv/objects.zip";

    protected $endpoint = self::REALWORKS_ENDPOINT;

    protected $username;

    protected $password;

    protected $office;

    public $fetch;

    public function __construct($username, $password, $office)
    {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setOffice($office);

        $this->fetch = new Fetcher($this);
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
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

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getOffice()
    {
        return $this->office;
    }

    /**
     * @param mixed $office
     */
    public function setOffice($office)
    {
        $this->office = $office;
    }
}