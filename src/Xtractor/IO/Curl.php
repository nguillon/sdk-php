<?php
/**
 * xtractor.io-php-sdk
 *
 * PHP Version 5.5
 *
 * @copyright 2015 organize.me GmbH (http://www.organize.me)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://xtractor.io
 */

namespace Xtractor\IO;

use Xtractor\Http;

/**
 * Class Curl
 *
 * This class encapsulate cURL requests.
 *
 * @package Xtractor\IO
 */
class Curl
{
    /**
     * @var resource
     *
     * Current cURL resource.
     */
    private $curlHandler = null;

    /**
     * __construct()
     *
     * Check if cURL extension is enabled and initialize cURL handler.
     *
     * @throws Exception
     */
    public function __construct()
    {
        if (!extension_loaded('curl')) {
            throw new Exception('The cURL IO handler requires the cURL extension to be enabled');
        }

        $this->curlHandler = curl_init();
    }

    /**
     * executeRequest(Request $request)
     *
     * This method execute cURL requests based on Xtractor\Http\Request object.
     * In this method some default cURL options are defined. But in fact
     * every option can be overwritten by a user.
     *
     * @param Http\Request $request
     * @return Http\Response
     * @throws Exception
     *
     * @TODO Make some changes to support GET requests with parameter.
     */
    public function executeRequest(Http\Request $request)
    {
        $this->setDefaultOptions($request);

        //Set postfields if method is POST
        if ($request->getRequestBody() && $request->getRequestMethod() === 'POST') {
            $this->setPostFields($request);
        }

        //Set headers
        $requestHeaders = $request->getRequestHeaderFields();
        if ($requestHeaders && is_array($requestHeaders)) {
            curl_setopt($this->curlHandler, CURLOPT_HTTPHEADER,
              $requestHeaders);
        }

        //Set/overwrite cURL options - defined by user.
        $this->addOrOverwriteRequestOptions($request);

        //Execute curl request
        $response = curl_exec($this->curlHandler);

        //Evaluate response
        $xtractorHttpResponse = $this->evaluateResponse($response);

        //Reset cURL handler in preparation for next call
        $this->resetCurlHandler();

        return $xtractorHttpResponse;
    }

    /**
     * setDefaultOptions(Request $request)
     *
     * Sets basic cURL options.
     *
     * @param Http\Request $request
     */
    private function setDefaultOptions(Http\Request $request)
    {
        curl_setopt($this->curlHandler, CURLOPT_URL, $request->getUrl());
        curl_setopt($this->curlHandler, CURLOPT_CUSTOMREQUEST,
          $request->getRequestMethod());
        curl_setopt($this->curlHandler, CURLOPT_SSL_VERIFYPEER, TRUE);
        curl_setopt($this->curlHandler, CURLOPT_SSLVERSION, 1);
        curl_setopt($this->curlHandler, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($this->curlHandler, CURLOPT_HEADER, TRUE);
        curl_setopt($this->curlHandler, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($this->curlHandler, CURLOPT_TIMEOUT, 30);
    }

    /**
     * setPostFields(Request $request)
     *
     * If the request method is POST we need to set postfields option to our
     * cURL request.
     *
     * @param Http\Request $request
     * @throws Exception
     */
    private function setPostFields(Http\Request $request)
    {
        $requestBody = $request->getRequestBody();

        if (!is_object($requestBody) || !is_a($requestBody,
            'Xtractor\Http\Body')
        ) {
            throw new Exception('Current "$requestBody" is no object or has unexpected class.');
        }

        if (!method_exists($requestBody, 'getFields')) {
            throw new Exception('Missing method "getFields" in class Xtractor\Http\Body.');
        }

        curl_setopt($this->curlHandler, CURLOPT_POSTFIELDS,
          $requestBody->getFields());
    }

    /**
     * addOrOverwriteRequestOptions(Request $request)
     *
     * You can overwrite or add any cURL option. In this method we set this options
     * to our cURL handler.
     *
     * @param Http\Request $request
     * @throws Exception
     *
     * @TODO Discuss which options should not be overwritable.
     */
    private function addOrOverwriteRequestOptions(Http\Request $request)
    {
        $requestOptions = $request->getRequestOptions();

        if (!is_object($requestOptions) || !is_a($requestOptions,
            'Xtractor\Http\Options')
        ) {
            throw new Exception('Current "$requestOptions" is no object or has unexpected class.');
        }

        if (!method_exists($requestOptions, 'getAll')) {
            throw new Exception('Missing method "getAll" in class Xtractor\Http\Options.');
        }

        foreach ($requestOptions->getAll() as $key => $var) {
            curl_setopt($this->curlHandler, $key, $var);
        }
    }

    /**
     * evaluateResponse($response)
     *
     * Evaluates the response from cURL request. If everything looks good
     * a response object will be built.
     *
     * @param $response
     * @return Http\Response
     * @throws Exception
     */
    private function evaluateResponse($response)
    {
        if ($response === FALSE) {
            $error = curl_error($this->curlHandler);
            $code = curl_errno($this->curlHandler);

            throw new Exception($error, $code);
        }

        $headerSize = curl_getinfo($this->curlHandler, CURLINFO_HEADER_SIZE);
        $responseCode = curl_getinfo($this->curlHandler, CURLINFO_HTTP_CODE);
        $totalTime = curl_getinfo($this->curlHandler, CURLINFO_TOTAL_TIME);

        return new Http\Response($responseCode, $headerSize, $totalTime,
          $response);
    }

    /**
     * resetCurlHandler()
     *
     * Resets cURL handler.
     *
     * If a user performs multiple cURL request in a row this method ensures
     * that every request can run without any sideeffects from other requests.
     */
    private function resetCurlHandler()
    {
        curl_close($this->curlHandler);
        $this->curlHandler = curl_init();
    }
}
