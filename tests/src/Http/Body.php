<?php
require_once realpath(__DIR__ . '/../../../src/Xtractor') . '/autoload.php';

use Xtractor\Http\Body;

class HttpBodyTest extends PHPUnit_Framework_TestCase
{
    private $body  = null;

    public function __construct()
    {
        $this->body = new Body();
    }

    public function testAddAndGetField()
    {
        $this->body->addField('myTestName', 'myTestValue');
        $this->assertCount(1, $this->body->getFields());
    }

    /**
     * @depends testAddAndGetField
     */
    public function testAddFileAsField()
    {
        $this->assertCount(0, $this->body->getFields());

        //Try to add filepath
        $file = realpath (__DIR__ . '/../../files') . '/example.jpg';

        $this->body->addField('file', $file);
        $fields = $this->body->getFields();

        $this->assertInstanceOf('CURLFile', $fields['file']);
    }

}