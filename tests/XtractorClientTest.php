<?php

class XtractorClientTest extends PHPUnit_Framework_TestCase
{
    private $xtractorClient = null;

    public function testConstruct()
    {
        $this->xtractorClient = new Xtractor_Client();
    }

    /*
     * @depends testConstruct
     */
    public function testUpload()
    {

    }
}