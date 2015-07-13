<?php
require_once realpath(__DIR__ . '/../../../src/Xtractor') . '/autoload.php';

use Xtractor\Http\Header;

class HttpHeaderTest extends PHPUnit_Framework_TestCase
{
    private $header  = null;

    public function __construct()
    {
        $this->header = new Header();
    }

    public function testGetField()
    {
        $this->assertEquals('application/json', $this->header->getField('Accept'));
    }

    /**
     * @depends testGetField
     * @expectedException \Xtractor\Exception
     */
    public function testGetFieldFailure()
    {
        $this->header->getField('Non-Existing-Header');
    }

    /**
     * @depends testGetField
     */
    public function testAddField()
    {
        $this->header->addField('Accept', 'text/html');
        $this->assertEquals('text/html', $this->header->getField('Accept'));
    }

    public function testGetFieldString()
    {
        $this->assertEquals('Accept: application/json',
          $this->header->getFieldString('Accept'));
    }

    /**
     * @depends testGetFieldString
     */
    public function testGetFieldStrings()
    {
        $fieldStrings = $this->header->getFieldStrings();
        $this->assertEquals('Accept: application/json', $fieldStrings[0]);
        $this->assertEquals('Accept-Version: 1.0.0', $fieldStrings[1]);
    }

}