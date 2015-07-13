<?php
require_once realpath(__DIR__ . '/../../../src/Xtractor') . '/autoload.php';

use Xtractor\Http\Request;
use Xtractor\Http\Header;

class HttpRequestTest extends PHPUnit_Framework_TestCase
{
    private $request = null;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function testSetRequestMethod()
    {
        $this->request->setRequestMethod('PUT');
        $this->assertEquals('PUT', $this->request->getRequestMethod());

        $this->request->setRequestMethod('delete');
        $this->assertEquals('DELETE', $this->request->getRequestMethod());
    }

    /**
     * @expectedException \Xtractor\Http\Exception
     */
    public function testSetRequestMethodFailure()
    {
        $this->request->setRequestMethod('DUMMY');
    }

    public function testSetUrl()
    {
        $this->request->setUrl('https://example.com');
        $this->assertEquals('https://example.com', $this->request->getUrl());
    }

    public function testSetRequestHeader()
    {
        $header = new Header();
        $this->request->setRequestHeader($header);
        $this->assertEquals($this->request->getRequestHeader(), array(
            'Accept: application/json',
            'Accept-Version: 1.0.0',
        ));
    }

}