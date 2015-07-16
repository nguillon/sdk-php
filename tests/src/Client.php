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


    /**
     * @expectedException Exception
     * @expectedExceptionMessage Missing api access token.
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
        $xtractorClient->disableSSLVerification();

        $response = $xtractorClient->upload($this->filesDir . '/example.pdf');

        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('meta', $response);
        $this->assertArrayHasKey('results', $response);

        $this->assertTrue(is_array($response['results']));
        $this->assertArrayHasKey('types', $response['results']);
        $this->assertArrayHasKey('categories', $response['results']);
        $this->assertArrayHasKey('payment', $response['results']);
    }

    public function testUploadWithOneExtractor()
    {
        $xtractorClient = new Client();
        $xtractorClient->setAccessToken(XTRACTOR_ACCESS_TOKEN);
        $xtractorClient->disableSSLVerification();

        $response = $xtractorClient->upload($this->filesDir . '/example.pdf', array('types'));

        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('meta', $response);
        $this->assertArrayHasKey('results', $response);

        $this->assertTrue(is_array($response['results']));
        $this->assertArrayHasKey('types', $response['results']);
        $this->assertFalse(array_key_exists('categories', $response['results']));
        $this->assertFalse(array_key_exists('payment', $response['results']));
    }
}
