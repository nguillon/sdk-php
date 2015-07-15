<?php
require_once realpath(__DIR__ . '/../../../src/Xtractor') . '/autoload.php';

use Xtractor\Utils\Files;

class XtractorUtilsFilesTest extends PHPUnit_Framework_TestCase
{
    private $workingDir = null;
    private $filesDir = null;

    public function __construct()
    {
        $this->workingDir = realpath(__DIR__);
        $this->filesDir = realpath($this->workingDir . '/../../files');
    }

    public function testIsValidFilePath()
    {
        //Empty path string
        $this->assertFalse(Files::isValidFilePath(''));

        //Non existing file
        $this->assertFalse(Files::isValidFilePath($this->filesDir . '/not-exist'));

        //Path to directory
        $this->assertFalse(Files::isValidFilePath($this->filesDir));

        //Valid file path
        $this->assertTrue(Files::isValidFilePath($this->filesDir . '/example.pdf'));
    }

    public function testGetMimeType()
    {
        $this->assertEquals(Files::getMimeType($this->filesDir . '/example.pdf'), 'application/pdf');
        $this->assertEquals(Files::getMimeType($this->filesDir . '/example.jpg'), 'image/jpeg');
        $this->assertEquals(Files::getMimeType($this->filesDir . '/example.png'), 'image/png');
    }

}
