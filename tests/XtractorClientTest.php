<?php



class XtractorClientTest extends PHPUnit_Framework_TestCase
{
  private $_xtractorClient = null;

  public function testConstruct()
  {
    $this->_xtractorClient = new Xtractor_Client();
  }

  /*
   * @depends testConstruct
   */
  public function testUpload()
  {

  }
}