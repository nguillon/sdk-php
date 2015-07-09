<?php

if (!class_exists('Xtractor_Client')) {
  require_once dirname(__FILE__) . '/../autoload.php';
}

/**
 * Class Xtractor_Http_Request
 *
 * This class delivers a business object to handle requests in a defined
 * structure.
 */
class Xtractor_Http_Request
{
  /**
   * @var string
   */
  private $requestUrl;
  /**
   * @var string
   */
  private $requestMethod = 'GET';
  /**
   * @var Xtractor_Http_Header
   */
  private $requestHeader;
  /**
   * @var Xtractor_Http_Body
   */
  private $requestBody;
  /**
   * @var Xtractor_Http_Options
   */
  private $requestOptions;

  /**
   * @param $method
   * @throws Xtractor_Http_Exception
   */
  public function setRequestMethod($method)
  {
    $method = strtoupper($method);
    $valid_methods = array('POST', 'GET', 'PUT', 'DELETE');

    if (!in_array($method, $valid_methods)) {
      throw new Xtractor_Http_Exception(sprintf('Invalid method called. - Called: %s', $method));
    }

    $this->requestMethod = strtoupper($method);
  }

  /**
   * @return string
   */
  public function getRequestMethod()
  {
    return $this->requestMethod;
  }

  /**
   * @param $requestUrl
   */
  public function setUrl($requestUrl)
  {
    $this->requestUrl = $requestUrl;
  }

  /**
   * @return mixed
   */
  public function getUrl()
  {
    return $this->requestUrl;
  }

  /**
   * @param Xtractor_Http_Header $headers
   */
  public function setRequestHeader(Xtractor_Http_Header $headers)
  {
    $this->requestHeader = $headers;
  }

  /**
   * @return mixed
   * @throws Xtractor_IO_Exception
   */
  public function getRequestHeader()
  {
    if ( !method_exists($this->requestHeader, 'getFieldStrings') ) {
      throw new Xtractor_IO_Exception('Missing method "getFieldStrings" in class Xtractor_Http_Header.');
    }

    return $this->requestHeader->getFieldStrings();
  }

  /**
   * @param Xtractor_Http_Body $body
   */
  public function setRequestBody(Xtractor_Http_Body $body)
  {
    $this->requestBody = $body;
  }

  /**
   * @return mixed
   */
  public function getRequestBody()
  {
    return $this->requestBody;
  }

  /**
   * @param Xtractor_Http_Options $options
   */
  public function setRequestOptions(Xtractor_Http_Options $options)
  {
    $this->requestOptions = $options;
  }

  /**
   * @return mixed
   */
  public function getRequestOptions()
  {
    return $this->requestOptions;
  }
}
