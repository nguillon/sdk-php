<?php

if (!class_exists('Xtractor_Client')) {
  require_once dirname(__FILE__) . '/../autoload.php';
}

class Xtractor_Http_Response
{
  private $_responseCode = null;
  private $_headerSize = null;
  private $_totalTime = null;
  private $_rawData = null;
  private $_parsedResult = array();

  public function __construct($responseCode, $headerSize, $totalTime, $responseData)
  {
    $this->setResponseCode($responseCode);
    $this->setHeaderSize($headerSize);
    $this->setTotalTime($totalTime);
    $this->setResponseRawData($responseData);
    $this->parse();
  }

  public function getResponseCode()
  {
    return $this->_responseCode;
  }

  public function getResponseHeader()
  {
    return $this->_parsedResult['responseHeader'];
  }

  public function setResponseHeader($responseHeader)
  {
    $this->_parsedResult['responseHeader'] = $responseHeader;
  }

  public function getResponseBody()
  {
    return $this->_parsedResult['responseBody'];
  }

  public function setResponseBody($responseBody)
  {
    $this->_parsedResult['responseBody'] = $responseBody;
  }

  private function setResponseCode($responseCode)
  {
    $this->_responseCode = $responseCode;
  }

  private function setResponseRawData($responseData)
  {
    $this->_rawData = $responseData;
  }

  private function setHeaderSize($headerSize)
  {
    $this->_headerSize = $headerSize;
  }

  private function setTotalTime($totalTime)
  {
    $this->_totalTime = $totalTime;
  }

  public function getTotalTime()
  {
    return (String) $this->_totalTime;
  }

  private function parse()
  {
    if ($this->_headerSize) {
      $responseBody = substr($this->_rawData, $this->_headerSize);
      $responseHeader = substr($this->_rawData, 0, $this->_headerSize);
    } else {
      $responseSegments = explode("\r\n\r\n", $this->_rawData, 2);
      $responseHeader = $responseSegments[0];
      $responseBody = isset($responseSegments[1]) ? $responseSegments[1] : null;
    }

    $responseHeader = $this->getHttpResponseHeader($responseHeader);

    $this->setResponseHeader($responseHeader);
    $this->setResponseBody($responseBody);
  }

  private function getHttpResponseHeader($rawHeaders)
  {
    if (is_array($rawHeaders)) {
      return $this->parseArrayHeaders($rawHeaders);
    } else {
      return $this->parseStringHeaders($rawHeaders);
    }
  }

  private function parseStringHeaders($rawHeaders)
  {
    $headers = array();
    $responseHeaderLines = explode("\r\n", $rawHeaders);
    foreach ($responseHeaderLines as $headerLine) {
      if ($headerLine && strpos($headerLine, ':') !== false) {
        list($header, $value) = explode(': ', $headerLine, 2);
        $header = strtolower($header);
        if (isset($headers[$header])) {
          $headers[$header] .= "\n" . $value;
        } else {
          $headers[$header] = $value;
        }
      }
    }
    return $headers;
  }

  private function parseArrayHeaders($rawHeaders)
  {
    $header_count = count($rawHeaders);
    $headers = array();

    for ($i = 0; $i < $header_count; $i++) {
      $header = $rawHeaders[$i];
      // Times will have colons in - so we just want the first match.
      $header_parts = explode(': ', $header, 2);
      if (count($header_parts) == 2) {
        $headers[strtolower($header_parts[0])] = $header_parts[1];
      }
    }

    return $headers;
  }
}
