<?php
require_once realpath(__DIR__ . '/../src/Xtractor') . '/autoload.php';

use Xtractor\Client;

class XtractorClientTest extends PHPUnit_Framework_TestCase
{
    private $xtractorClient = null;

    public function testConstruct()
    {
        $this->assertInstanceOf('Xtractor\Client', new Client);
    }

    /*
     * @depends testConstruct
     */
    public function testConstructWithUrlOverride()
    {
        $client = new Client('non-valid-api-url');
        $this->assertNotEquals($client->getApiUrl(), 'non-valid-api-url');
        $this->assertEquals($client->getApiUrl(), 'https://api.xtractor.io');
    }

    /*
     * @depends testConstruct
     */
    public function testUpload()
    {

    }
}