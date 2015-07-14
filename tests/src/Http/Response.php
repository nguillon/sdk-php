<?php
require_once realpath(__DIR__ . '/../../../src/Xtractor') . '/autoload.php';

use Xtractor\Http\Response;

class HttpResponseTest extends PHPUnit_Framework_TestCase
{
    private $workingDir = null;
    private $filesDir = null;
    private $response = null;

    public function __construct()
    {
        $this->workingDir = realpath(__DIR__);
        $this->filesDir = realpath($this->workingDir . '/../../files');
        $dummmyResponse = file_get_contents($this->filesDir . '/dummyResponse.txt');

        $this->response = new Response( 200, 320, 2.949, $dummmyResponse );
    }

    public function testGetResponseCode()
    {
        $this->assertEquals(200, $this->response->getResponseCode());
    }

    public function testSetResponseBody()
    {
        $this->response->setResponseBody('testBody');
        $this->assertEquals('testBody', $this->response->getResponseBody());
    }

    public function testGetTotalTime()
    {
        $this->assertEquals(2.949, $this->response->getTotalTime());
    }

}