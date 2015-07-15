<?php
require_once realpath(__DIR__ . '/../../src/Xtractor') . '/autoload.php';

use Xtractor\Client;

class XtractorClientTest extends PHPUnit_Framework_TestCase
{
    private $workingDir = null;
    private $filesDir = null;

    public function __construct()
    {
        $this->workingDir = realpath(__DIR__);
        $this->filesDir = realpath($this->workingDir . '/../files');
    }

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

    /**
     * @expectedException \Xtractor\Exception
     * @expectedExceptionMessage Missing api key. You have to set them first.
     */
    public function testUploadFailureMissingApiKey()
    {
        $xtractorClient = new Client();
        $xtractorClient->upload($this->filesDir . '/example.pdf');
    }

    /**
     * @expectedException \Xtractor\Exception
     * @expectedExceptionMessage Invalid file path.
     */
    public function testUploadFailurePathLeadsToDirectory()
    {
        $xtractorClient = new Client();
        $xtractorClient->upload($this->filesDir);
    }

    /**
     * @expectedException \Xtractor\Exception
     * @expectedExceptionMessage Invalid file path.
     */
    public function testUploadFailurePathNotExist()
    {
        $xtractorClient = new Client();
        $xtractorClient->upload($this->filesDir . '/not-exists.jpg');
    }

    public function testUploadWithAllExtractors()
    {
        $xtractorClient = new Client();
        $xtractorClient->setAccessToken(XTRACTOR_ACCESS_TOKEN);
        $response = $xtractorClient->upload($this->filesDir . '/example.pdf');

        $this->assertInstanceOf('Xtractor\Http\Response', $response);
        $responseBody  = $response->getResponseBody();

        $this->assertTrue(is_array($responseBody));
        $this->assertArrayHasKey('meta', $responseBody);
        $this->assertArrayHasKey('results', $responseBody);

        $this->assertTrue(is_array($responseBody['results']));
        $this->assertArrayHasKey('types', $responseBody['results']);
        $this->assertArrayHasKey('categories', $responseBody['results']);
        $this->assertArrayHasKey('payment', $responseBody['results']);
    }

    public function testUploadWithOneExtractor()
    {
        $xtractorClient = new Client();
        $xtractorClient->setAccessToken(XTRACTOR_ACCESS_TOKEN);
        $response = $xtractorClient->upload($this->filesDir . '/example.pdf', array('types'));

        $this->assertInstanceOf('Xtractor\Http\Response', $response);
        $responseBody  = $response->getResponseBody();

        $this->assertTrue(is_array($responseBody));
        $this->assertArrayHasKey('meta', $responseBody);
        $this->assertArrayHasKey('results', $responseBody);

        $this->assertTrue(is_array($responseBody['results']));
        $this->assertArrayHasKey('types', $responseBody['results']);
        $this->assertFalse(array_key_exists('categories', $responseBody['results']));
        $this->assertFalse(array_key_exists('payment', $responseBody['results']));
    }
}
