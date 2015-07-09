<?php
if (!class_exists('Xtractor_Client')) {
  require_once dirname(__FILE__) . '/../autoload.php';
}

/**
 * Class Xtractor_Auth_Base
 *
 * This class is used to set the authentication header for API calls.
 */
class Xtractor_Auth_Base
{
  /**
   * @var String
   */
  private $_accessToken = null;
  /**
   * @var Xtractor_Http_Header
   */
  private $_header = null;

  /**
   * @param Xtractor_Http_Header $header
   */
  public function __construct(Xtractor_Http_Header $header)
  {
    $this->_header = $header;
  }

  /**
   * @param $accessToken
   * @throws Xtractor_Auth_Exception
   *
   * Checks the given access token and set them to class property to use them
   * in class methods.
   *
   * After that this value is setted to header object.
   */
  public function setAccessToken($accessToken)
  {
    $accessToken = trim($accessToken);

    if ( empty($accessToken) === TRUE ) {
      throw new Xtractor_Auth_Exception('Given $code is empty.');
    }

    $this->_accessToken = (String) $accessToken;
    $this->setAccessKeyToHeader();
  }

  /**
   * @return null
   */
  public function getAccessToken()
  {
    return $this->_accessToken;
  }

  /**
   * @return bool
   *
   * Checks if an access token is set.
   */
  public function hasAccessToken()
  {
    return (is_null($this->_accessToken)) ? FALSE : TRUE;
  }

  /**
   * @throws Xtractor_Auth_Exception
   *
   * Sets current access token to header object. This ensures (if token is
   * known by api) an authenticated request.
   */
  private function setAccessKeyToHeader()
  {
    if (is_null($this->_header)) {
      throw new Xtractor_Auth_Exception('Missing Xtractor_Http_Header object.');
    }

    $this->_header->addField('X-API-Key', $this->getAccessToken());
  }
}
