<?php

if (!class_exists('Xtractor_Client')) {
  require_once dirname(__FILE__) . '/../autoload.php';
}

class Xtractor_IO_Curl
{
  private static function _init()
  {
    if (!extension_loaded('curl')) {
      $error = 'The cURL IO handler requires the cURL extension to be enabled';
      throw new Xtractor_IO_Exception($error);
    }
  }

  /**
   * @param Xtractor_Http_Request $request
   * @return Xtractor_Http_Response
   * @throws Xtractor_IO_Exception
   */
  public static function executeRequest(Xtractor_Http_Request $request)
  {
    self::_init();

    $curlHandler = curl_init();

    //Set default options
    curl_setopt($curlHandler, CURLOPT_URL, $request->getUrl());
    curl_setopt($curlHandler, CURLOPT_CUSTOMREQUEST, $request->getRequestMethod());
    curl_setopt($curlHandler, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($curlHandler, CURLOPT_SSLVERSION, 1);
    curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlHandler, CURLOPT_HEADER, true);
    curl_setopt($curlHandler, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($curlHandler, CURLOPT_TIMEOUT, 30);

    //Set postfields if method is POST
    if ($request->getRequestBody() && $request->getRequestMethod() === 'POST') {
      $requestBody = $request->getRequestBody();

      if (!is_object($requestBody) || is_a($requestBody, 'Xtractor_Http_Body')) {
        throw new Xtractor_IO_Exception('Current "$requestBody" is no object or has unexpected class.');
      }

      if ( !method_exists($requestBody, 'getFields') ) {
        throw new Xtractor_IO_Exception('Missing method "getFields" in class Xtractor_Http_Body.');
      }

      curl_setopt($curlHandler, CURLOPT_POSTFIELDS, $requestBody->getFields());
    }

    //Set headers
    $requestHeaders = $request->getRequestHeader();
    if ($requestHeaders && is_array($requestHeaders)) {
      curl_setopt($curlHandler, CURLOPT_HTTPHEADER, $requestHeaders);
    }

    //Overwrite or set explicitly defined cURL options.
    $requestOptions = $request->getRequestOptions();

    if (!is_object($requestOptions) || is_a($requestOptions, 'Xtractor_Http_Options')) {
      throw new Xtractor_IO_Exception('Current "$requestOptions" is no object or has unexpected class.');
    }

    if ( !method_exists($requestOptions, 'getAll') ) {
      throw new Xtractor_IO_Exception('Missing method "getAll" in class Xtractor_Http_Options.');
    }

    foreach ($requestOptions->getAll() as $key => $var) {
      curl_setopt($curlHandler, $key, $var);
    }

    //Execute curl request
    $response = curl_exec($curlHandler);

    if ($response === false) {
      $error = curl_error($curlHandler);
      $code = curl_errno($curlHandler);

      throw new Xtractor_IO_Exception($error, $code);
    }

    $headerSize = curl_getinfo($curlHandler, CURLINFO_HEADER_SIZE);
    $responseCode = curl_getinfo($curlHandler, CURLINFO_HTTP_CODE);
    $totalTime = curl_getinfo($curlHandler, CURLINFO_TOTAL_TIME);

    curl_close($curlHandler);

    return new Xtractor_Http_Response($responseCode, $headerSize, $totalTime, $response);
  }

}
