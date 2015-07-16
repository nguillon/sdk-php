<?php
require_once realpath(__DIR__ . '/../../../src/Xtractor') . '/autoload.php';

use Xtractor\Utils\Arrays;

class XtractorUtilsArraysTest extends PHPUnit_Framework_TestCase
{

    public function testAllValuesAreStrings()
    {
        //Empty array
        $this->assertTrue(Arrays::allValuesAreStrings(array()));

        //In-valid array
        $inValidArray = array('a', 'b', 1, array('a'));
        $this->assertFalse(Arrays::allValuesAreStrings($inValidArray));

        //Valid array
        $validArray = array('a', 'b', 'c');
        $this->assertTrue(Arrays::allValuesAreStrings($validArray));

    }

}
