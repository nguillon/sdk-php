<?php
if (!class_exists('Xtractor_Client')) {
  require_once dirname(__FILE__) . '/../autoload.php';
}

class Xtractor_Client_Base extends Xtractor_Auth_Base
{
  private $_defaultApiUrl       = 'https://api.xtractor.io';
  private $_apiUrl              = NULL;
  private $_request             = NULL;
  private $_last_request_response = null;

  protected $_header  = NULL;
  protected $_body    = NULL;
  protected $_options = NULL;

  public function __construct($apiUrl = NULL)
  {
    //Init objects
    $this->_request = new Xtractor_Http_Request();
    $this->_header = new Xtractor_Http_Header();
    $this->_body = new Xtractor_Http_Body();
    $this->_options = new Xtractor_Http_Options();

    //Set defaults
    $this->_setApiUrl($apiUrl);
    $this->_header->setBaseFields();

    //Parent Constructor
    parent::__construct($this->_header);
  }

  protected function setRequestMethod($method)
  {
    $this->_request->setRequestMethod($method);
  }

  /**
   * @return Xtractor_Http_Response
   * @throws Xtractor_Exception
   * @throws Xtractor_Http_Exception
   * @throws Xtractor_IO_Exception
   */
  protected function executeRequest()
  {
    if (!$this->hasAccessToken()) {
      throw new Xtractor_Http_Exception('Missing api key. You have to set them first.');
    }

    $this->_request->setUrl($this->_apiUrl);
    $this->_request->setRequestHeader($this->_header);
    $this->_request->setRequestBody($this->_body);
    $this->_request->setRequestOptions($this->_options);

    $this->_last_request_response = Xtractor_IO_Curl::executeRequest($this->_request);
    $this->decodeResponseBody();

    return $this->_last_request_response;
  }

  /**
   * Every response from our API should be a JSON encoded string. This precondition
   * in mind it makes sense to decode every valid responseBody automatically to
   * a php usable structure (objects will be converted to arrays).
   *
   * This method works silently if no json content was returned.
   *
   * @throws Xtractor_Exception
   */
  private function decodeResponseBody()
  {
    if ( !method_exists($this->_last_request_response, 'getResponseHeader') ) {
      throw new Xtractor_IO_Exception('Missing method "getResponseHeader" in class Xtractor_Http_Response.');
    }

    if ( !method_exists($this->_last_request_response, 'setResponseBody') ) {
      throw new Xtractor_IO_Exception('Missing method "setResponseBody" in class Xtractor_Http_Response.');
    }

    if ( !method_exists($this->_last_request_response, 'getResponseBody') ) {
      throw new Xtractor_IO_Exception('Missing method "getResponseBody" in class Xtractor_Http_Response.');
    }

    $responseHeader = $this->_last_request_response->getResponseHeader();

    if (  is_array($responseHeader) &&
          array_key_exists('content-type', $responseHeader) &&
          strtolower($responseHeader['content-type']) === 'application/json' )
    {
      $decodedResponseBody = json_decode( $this->_last_request_response->getResponseBody(), TRUE );

      if (empty($decodedResponseBody)) {
        throw new Xtractor_Exception('Error on decoding responseBody, don\'t match with content-type.');
      }

      $this->_last_request_response->setResponseBody($decodedResponseBody);
    }
  }

  private function _setApiUrl($apiUrl)
  {
    if (!is_null($apiUrl)) {
      if (Xtractor_Utils_Url::isValidUrl($this->_apiUrl)) {
        $this->_apiUrl = trim($apiUrl);
      } else {
        $this->_apiUrl = $this->_defaultApiUrl;
      }
    } else {
      $this->_apiUrl = $this->_defaultApiUrl;
    }
  }

}
