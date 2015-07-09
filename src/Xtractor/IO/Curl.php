<?php

if (!class_exists('Xtractor_Client')) {
  require_once dirname(__FILE__) . '/../autoload.php';
}

/**
 * Class Xtractor_IO_Curl
 *
 * This class encapsulate cURL request.
 */
class Xtractor_IO_Curl
{
  /**
   * @var null
   */
  private $_curlHandler = null;

  /**
   * @throws Xtractor_IO_Exception
   *
   * Check if cURL extension is enabled and initialize cURL handler.
   */
  public function __construct()
  {
    if (!extension_loaded('curl')) {
      throw new Xtractor_IO_Exception('The cURL IO handler requires the cURL extension to be enabled');
    }

    $this->_curlHandler = curl_init();
  }

  /**
   * @param Xtractor_Http_Request $request
   * @return Xtractor_Http_Response
   * @throws Xtractor_IO_Exception
   *
   * This method executes cURL request based on Xtracotr_Http_Request object.
   * In this method some default cURL options are defined. But in fact
   * every option can be overriden if a user setted them to request object.
   */
  public function executeRequest(Xtractor_Http_Request $request)
  {
    $this->setDefaultOptions($request);

    //Set postfields if method is POST
    if ($request->getRequestBody() && $request->getRequestMethod() === 'POST') {
      $this->setPostFields($request);
    }

    //Set headers
    $requestHeaders = $request->getRequestHeader();
    if ($requestHeaders && is_array($requestHeaders)) {
      curl_setopt($this->_curlHandler, CURLOPT_HTTPHEADER, $requestHeaders);
    }

    //Override or set explicitly defined cURL options.
    $this->addOrOverrideRequestOptions($request);

    //Execute curl request
    $response = curl_exec($this->_curlHandler);

    //Evaluate Response
    $xtractorHttpResponse = $this->evaluateResponse($response);

    //Reset cURL handler in preparation for next call
    $this->resetCurlHandler();

    return $xtractorHttpResponse;
  }

  /**
   * @param Xtractor_Http_Request $request
   *
   * Sets basic cURL options.
   */
  private function setDefaultOptions(Xtractor_Http_Request $request)
  {
    curl_setopt($this->_curlHandler, CURLOPT_URL, $request->getUrl());
    curl_setopt($this->_curlHandler, CURLOPT_CUSTOMREQUEST, $request->getRequestMethod());
    curl_setopt($this->_curlHandler, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($this->_curlHandler, CURLOPT_SSLVERSION, 1);
    curl_setopt($this->_curlHandler, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($this->_curlHandler, CURLOPT_HEADER, true);
    curl_setopt($this->_curlHandler, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($this->_curlHandler, CURLOPT_TIMEOUT, 30);
  }

  /**
   * @param Xtractor_Http_Request $request
   * @throws Xtractor_IO_Exception
   *
   * If the request method is POST we need to set postfields options to our
   * cURL request.
   */
  private function setPostFields(Xtractor_Http_Request $request)
  {
    $requestBody = $request->getRequestBody();

    if (!is_object($requestBody) || !is_a($requestBody, 'Xtractor_Http_Body')) {
      throw new Xtractor_IO_Exception('Current "$requestBody" is no object or has unexpected class.');
    }

    if ( !method_exists($requestBody, 'getFields') ) {
      throw new Xtractor_IO_Exception('Missing method "getFields" in class Xtractor_Http_Body.');
    }

    curl_setopt($this->_curlHandler, CURLOPT_POSTFIELDS, $requestBody->getFields());
  }

  /**
   * @param Xtractor_Http_Request $request
   * @throws Xtractor_IO_Exception
   *
   * You can override or add any cURL option. In this method we set this options
   * to our cURL handler.
   */
  private function addOrOverrideRequestOptions(Xtractor_Http_Request $request)
  {
    $requestOptions = $request->getRequestOptions();

    if (!is_object($requestOptions) || !is_a($requestOptions, 'Xtractor_Http_Options')) {
      throw new Xtractor_IO_Exception('Current "$requestOptions" is no object or has unexpected class.');
    }

    if ( !method_exists($requestOptions, 'getAll') ) {
      throw new Xtractor_IO_Exception('Missing method "getAll" in class Xtractor_Http_Options.');
    }

    foreach ($requestOptions->getAll() as $key => $var) {
      curl_setopt($this->_curlHandler, $key, $var);
    }
  }

  /**
   * @param $response
   * @return Xtractor_Http_Response
   * @throws Xtractor_IO_Exception
   *
   * Evaluates the response from cURL call. If everything looks good
   * a response object will be built.
   */
  private function evaluateResponse($response)
  {
    if ($response === false) {
      $error = curl_error($this->_curlHandler);
      $code = curl_errno($this->_curlHandler);

      throw new Xtractor_IO_Exception($error, $code);
    }

    $headerSize = curl_getinfo($this->_curlHandler, CURLINFO_HEADER_SIZE);
    $responseCode = curl_getinfo($this->_curlHandler, CURLINFO_HTTP_CODE);
    $totalTime = curl_getinfo($this->_curlHandler, CURLINFO_TOTAL_TIME);

    return new Xtractor_Http_Response($responseCode, $headerSize, $totalTime, $response);
  }

  /**
   * Resets cURL handler.
   */
  private function resetCurlHandler()
  {
    curl_close($this->_curlHandler);
    $this->_curlHandler = curl_init();
  }
}
