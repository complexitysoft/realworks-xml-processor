<?php

use PHPUnit\Framework\TestCase;
use RealworksXmlProcessor\Realworks;

class HousesTest extends TestCase
{
    protected $realworks;

    public function setUp()
    {
        $this->realworks = new Realworks('username', 'password', 'office');
    }

    public function testFetchHouses()
    {
        var_dump($this->realworks->fetch->houses());
    }
}