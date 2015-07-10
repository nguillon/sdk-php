<?php
namespace Xtractor\IO;
use Xtractor\Http;


/**
 * Class Xtractor\IO\Curl
 *
 * This class encapsulate cURL request.
 */
class Curl
{
  /**
   * @var null
   */
  private $_curlHandler = null;

  /**
   * @throws Exception
   *
   * Check if cURL extension is enabled and initialize cURL handler.
   */
  public function __construct()
  {
    if (!extension_loaded('curl')) {
      throw new Exception('The cURL IO handler requires the cURL extension to be enabled');
    }

    $this->_curlHandler = curl_init();
  }

  /**
   * @param Http\Request $request
   * @return Http\Response
   * @throws Exception
   *
   * This method executes cURL request based on Xtracotr_Http_Request object.
   * In this method some default cURL options are defined. But in fact
   * every option can be overriden if a user setted them to request object.
   */
  public function executeRequest(Http\Request $request)
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
   * @param Http\Request $request
   *
   * Sets basic cURL options.
   */
  private function setDefaultOptions(Http\Request $request)
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
   * @param Http\Request $request
   * @throws Exception
   *
   * If the request method is POST we need to set postfields options to our
   * cURL request.
   */
  private function setPostFields(Http\Request $request)
  {
    $requestBody = $request->getRequestBody();

    if (!is_object($requestBody) || !is_a($requestBody, 'Xtractor\Http\Body')) {
      throw new Exception('Current "$requestBody" is no object or has unexpected class.');
    }

    if ( !method_exists($requestBody, 'getFields') ) {
      throw new Exception('Missing method "getFields" in class Xtractor\Http\Body.');
    }

    curl_setopt($this->_curlHandler, CURLOPT_POSTFIELDS, $requestBody->getFields());
  }

  /**
   * @param Http\Request $request
   * @throws Exception
   *
   * You can override or add any cURL option. In this method we set this options
   * to our cURL handler.
   */
  private function addOrOverrideRequestOptions(Http\Request $request)
  {
    $requestOptions = $request->getRequestOptions();

    if (!is_object($requestOptions) || !is_a($requestOptions, 'Xtractor\Http\Options')) {
      throw new Exception('Current "$requestOptions" is no object or has unexpected class.');
    }

    if ( !method_exists($requestOptions, 'getAll') ) {
      throw new Exception('Missing method "getAll" in class Xtractor\Http\Options.');
    }

    foreach ($requestOptions->getAll() as $key => $var) {
      curl_setopt($this->_curlHandler, $key, $var);
    }
  }

  /**
   * @param $response
   * @return Http\Response
   * @throws Exception
   *
   * Evaluates the response from cURL call. If everything looks good
   * a response object will be built.
   */
  private function evaluateResponse($response)
  {
    if ($response === false) {
      $error = curl_error($this->_curlHandler);
      $code = curl_errno($this->_curlHandler);

      throw new Exception($error, $code);
    }

    $headerSize = curl_getinfo($this->_curlHandler, CURLINFO_HEADER_SIZE);
    $responseCode = curl_getinfo($this->_curlHandler, CURLINFO_HTTP_CODE);
    $totalTime = curl_getinfo($this->_curlHandler, CURLINFO_TOTAL_TIME);

    return new Http\Response($responseCode, $headerSize, $totalTime, $response);
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
