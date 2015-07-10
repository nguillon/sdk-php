<?php
require_once realpath(__DIR__ . '/../src/Xtractor') . '/autoload.php';

use Xtractor\Utils\Files;

class XtractorUtilsFilesTest extends PHPUnit_Framework_TestCase
{
    private $workingDir = null;

    public function __construct()
    {
        $this->workingDir = realpath(__DIR__);
        parent::__construct();
    }

    public function testIsValidFilePath()
    {
        //Empty path string
        $this->assertFalse(Files::isValidFilePath(''));

        //Non existing file
        $this->assertFalse(Files::isValidFilePath($this->workingDir . '/not-exist'));

        //Path to directory
        $this->assertFalse(Files::isValidFilePath($this->workingDir . '/files'));

        //Valid file path
        $this->assertTrue(Files::isValidFilePath($this->workingDir . '/files/example.pdf'));
    }

    public function testGetMimeType()
    {
        $this->assertEquals(Files::getMimeType($this->workingDir . '/files/example.pdf'), 'application/pdf');
        $this->assertEquals(Files::getMimeType($this->workingDir . '/files/example.jpg'), 'image/jpeg');
        $this->assertEquals(Files::getMimeType($this->workingDir . '/files/example.png'), 'image/png');
    }

    public function testIsValidFileType()
    {
        //Unsupported Mime-Type
        $this->assertFalse(Files::isValidFileType($this->workingDir . '/files/example.txt'));

        //Supported Mime-Type
        $this->assertTrue(Files::isValidFileType($this->workingDir . '/files/example.jpg'));
    }
}