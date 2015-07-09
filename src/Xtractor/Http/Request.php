<?php

if (!class_exists('Xtractor_Client')) {
  require_once dirname(__FILE__) . '/../autoload.php';
}

class Xtractor_Http_Request
{
  private $requestUrl;
  private $requestMethod = 'GET';
  private $requestHeader;
  private $requestBody;
  private $requestOptions;

  public function setRequestMethod($method)
  {
    $method = strtoupper($method);
    $valid_methods = array('POST', 'GET', 'PUT', 'DELETE');

    if (!in_array($method, $valid_methods)) {
      throw new Xtractor_Http_Exception(sprintf('Invalid method called. - Called: %s', $method));
    }

    $this->requestMethod = strtoupper($method);
  }

  public function getRequestMethod()
  {
    return $this->requestMethod;
  }

  public function setUrl($requestUrl)
  {
    $this->requestUrl = $requestUrl;
  }

  public function getUrl()
  {
    return $this->requestUrl;
  }

  public function setRequestHeader(Xtractor_Http_Header $headers)
  {
    $this->requestHeader = $headers;
  }

  public function getRequestHeader()
  {
    if ( !method_exists($this->requestHeader, 'getFieldStrings') ) {
      throw new Xtractor_IO_Exception('Missing method "getFieldStrings" in class Xtractor_Http_Header.');
    }

    return $this->requestHeader->getFieldStrings();
  }

  public function setRequestBody(Xtractor_Http_Body $body)
  {
    $this->requestBody = $body;
  }

  public function getRequestBody()
  {
    return $this->requestBody;
  }

  public function setRequestOptions(Xtractor_Http_Options $options)
  {
    $this->requestOptions = $options;
  }

  public function getRequestOptions()
  {
    return $this->requestOptions;
  }
}
