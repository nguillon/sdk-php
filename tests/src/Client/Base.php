<?php
require_once realpath(__DIR__ . '/../../../src/Xtractor') . '/autoload.php';

use Xtractor\Client;

class ClientBaseTest extends PHPUnit_Framework_TestCase
{
    private $clientBase = null;

    public function __construct()
    {
        $this->clientBase = new Client\Base();
    }

    public function testConstructor()
    {
        $defaultObject = new Client\Base();
        $this->assertEquals('https://api.xtractor.io', $defaultObject->getApiUrl());

        $specifiedUrlObject = new Client\Base('https://dummy.xtractor.io');
        $this->assertEquals('https://dummy.xtractor.io', $specifiedUrlObject->getApiUrl());
    }

    public function testSetAPIVersion()
    {
        $this->assertEquals($this->clientBase->getApiVersion(), '1.0.0');

        $this->clientBase->setApiVersion('1.0.1');
        $this->assertEquals($this->clientBase->getApiVersion(), '1.0.1');
    }

    /**
     * @expectedException vierbergenlars\SemVer\SemVerException
     */
    public function testSetAPIVersionFailure()
    {
        $this->clientBase->setApiVersion('non-valid');
    }

}
