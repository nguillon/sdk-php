<?php
require_once realpath(__DIR__ . '/../../../src/Xtractor') . '/autoload.php';

use Xtractor\Http\Options;

class HttpOptionsTest extends PHPUnit_Framework_TestCase
{
    private $options = null;

    public function __construct()
    {
        $this->options = new Options();
    }

    public function testAddOption()
    {
        $this->options->addOption(0, 'testValue');
        $this->assertEquals('testValue', $this->options->getOption(0));
    }

    /**
     * @depends testAddOption
     */
    public function testGetAll()
    {
        $this->options->addOption(0, 'testValue1');
        $this->options->addOption(1, 'testValue2');

        $all = $this->options->getAll();

        $this->assertEquals($all, array(
          'testValue1',
          'testValue2'
        ));
    }

}