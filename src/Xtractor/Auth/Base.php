<?php
if (!class_exists('Xtractor_Client')) {
  require_once dirname(__FILE__) . '/../autoload.php';
}

class Xtractor_Auth_Base
{
  private $_code = null;
  private $_header = null;

  public function __construct(Xtractor_Http_Header $header)
  {
    $this->_header = $header;
  }

  public function setAccessToken($code)
  {
    $code = trim($code);

    if ( empty($code) === TRUE ) {
      throw new Xtractor_Auth_Exception('Given $code is empty.');
    }

    $this->_code = $code;
    $this->setAccessKeyToHeader();
  }

  public function getAccessToken()
  {
    return $this->_code;
  }

  public function hasAccessToken()
  {
    return (is_null($this->_code)) ? FALSE : TRUE;
  }

  private function setAccessKeyToHeader()
  {
    if (is_null($this->_header)) {
      throw new Xtractor_Auth_Exception('Missing Xtractor_Http_Header object.');
    }

    $this->_header->addField('X-API-Key', $this->getAccessToken());
  }
}
