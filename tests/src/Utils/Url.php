<?php
require_once realpath(__DIR__ . '/../../../src/Xtractor') . '/autoload.php';

use Xtractor\Utils\Url;

class XtractorUtilsUrlTest extends PHPUnit_Framework_TestCase
{

    public function testInvalidUrl()
    {
        $this->assertFalse(Url::isValidUrl(''));
        $this->assertFalse(Url::isValidUrl('some-string'));
    }


    public function testValidUrl()
    {
        $this->assertTrue(Url::isValidUrl('http://example.com'));
        $this->assertTrue(Url::isValidUrl('https://example.com'));
        $this->assertTrue(Url::isValidUrl('http://www.example.com'));
        $this->assertTrue(Url::isValidUrl('http://www.example.com?foo=bar'));
    }
}