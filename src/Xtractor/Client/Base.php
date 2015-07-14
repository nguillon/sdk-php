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

namespace Xtractor\Client;

use Xtractor\Auth;
use Xtractor\Exception;
use Xtractor\Http;
use Xtractor\Utils\Url;
use Xtractor\IO\Curl;

/**
 * Class Base
 *
 * This class contain methods for our client class.
 *
 * We move ththa methods from our client class to ensure a readable, clean
 * source in that file.
 *
 * @package Xtractor\Client
 */
class Base extends Auth\Base
{
    /**
     * @var Http\Header
     *
     * Request header object
     */
    protected $header = NULL;
    /**
     * @var Http\Body
     *
     * Request body object
     */
    protected $body = NULL;
    /**
     * @var Http\Options
     *
     * Request options object
     */
    protected $options = NULL;
    /**
     * @var string
     *
     * Default api url
     */
    private $defaultApiUrl = 'https://api.xtractor.io';
    /**
     * @var string
     *
     * Current request api url
     */
    private $apiUrl = NULL;
    /**
     * @var string
     *
     * Current request api route
     */
    private $apiRoute = '/';
    /**
     * @var Http\Request
     *
     * Current request object
     */
    private $request = NULL;
    /**
     * @var Http\Response
     *
     * Last request response
     */
    private $lastRequestResponse = NULL;

    /**
     * __construct([string $apiUrl = NULL])
     *
     * @param $apiUrl
     */
    public function __construct($apiUrl = NULL)
    {
        //Init objects
        $this->request = new Http\Request();
        $this->header = new Http\Header();
        $this->body = new Http\Body();
        $this->options = new Http\Options();

        //Set defaults
        $this->setApiUrl($apiUrl);

        //Parent Constructor
        parent::__construct($this->header);
    }

    /**
     * setApiUrl(string $apiUrl)
     *
     * During instanciation of client object a user can override default api url.
     * (e.g. we have a complete new url for future api versions or for prod,
     * dev environment)
     *
     * This method ensures a valid url and set them to our class property.
     *
     * @param $apiUrl
     */
    private function setApiUrl($apiUrl)
    {
        if (!is_null($apiUrl)) {
            if (Url::isValidUrl($apiUrl)) {
                $this->apiUrl = trim($apiUrl);
            } else {
                $this->apiUrl = $this->defaultApiUrl;
            }
        } else {
            $this->apiUrl = $this->defaultApiUrl;
        }
    }

    /**
     * setAPIVersion(string $apiVersion)
     *
     * Set the used API version. The given version string have to be formated
     * like this.
     *
     * [number].[number].[number]
     *
     * Each number contains 1 or 2 digits.
     *
     * @param $apiVersion
     * @throws \Xtractor\Exception
     */
    public function setAPIVersion($apiVersion)
    {
        if (!preg_match('/^(\d{1,2}\.\d{1,2}\.\d{1,2}){1}$/i', $apiVersion)) {
            throw new Exception('Malformed API-Version string.');
        }

        $this->header->addField('Accept-Version', $apiVersion);
    }

    /**
     * getAPIVersion()
     *
     * Returns the selected API version.
     *
     * @return string
     * @throws Http\Exception
     */
    public function getAPIVersion()
    {
        return $this->header->getField('Accept-Version');
    }

    /**
     * getApiRoute()
     *
     * Returns the current apiRoute.
     *
     * @return string
     */
    public function getApiRoute()
    {
        return $this->apiRoute;
    }

    /**
     * setApiRoute(string $apiRoute)
     *
     * This method helps to specify the correct route against our REST API.
     *
     * @param $apiRoute
     * @throws Exception
     */
    protected function setApiRoute($apiRoute)
    {
        if (empty($apiRoute)) {
            throw new Exception('Cannot set empty apiRoute.');
        }

        if (!preg_match('/^(\/[^\s]*)$/i', $apiRoute)) {
            throw new Exception('Given apiRoute contain whitespaces.');
        }

        $this->apiRoute = trim($apiRoute);
    }

    /**
     * getLastResponse()
     *
     * Returns the last response object. If there is no last response
     * the return value will be NULL.
     *
     * @return Response
     */
    public function getLastResponse()
    {
        return $this->lastRequestResponse;
    }

    /**
     * setRequestMethod(string $method)
     *
     * Sets the request method. Actually only the method "POST"
     * makes a difference, because in this case we need to set CURLOPT_POSTFIELDS
     * during cURL request.
     *
     * Currently we support: GET, POST, PUT, DELETE
     *
     * @param $method
     * @throws Http\Exception
     */
    protected function setRequestMethod($method)
    {
        $this->request->setRequestMethod($method);
    }

    /**
     * executeRequest()
     *
     * This method sets the required values and objects to the $request instance
     * and execute request.
     *
     * @return Http\Response
     * @throws Auth\Exception
     * @throws Http\Exception
     */
    protected function executeRequest()
    {
        if (!$this->hasAccessToken()) {
            throw new Auth\Exception('Missing api key. You have to set them first.');
        }

        $xtractorIoCurl = new Curl();

        $this->request->setUrl($this->getRequestUrl());
        $this->request->setRequestHeader($this->header);
        $this->request->setRequestBody($this->body);
        $this->request->setRequestOptions($this->options);

        $this->lastRequestResponse = $xtractorIoCurl->executeRequest($this->request);
        $this->decodeResponseBody();

        return $this->lastRequestResponse;
    }

    /**
     * getRequestUrl()
     *
     * This method concatinates apiUrl and apiRoute to the final request url
     * against xtractor.io api.
     *
     * @return string
     * @throws Exception
     */
    private function getRequestUrl()
    {
        $requestUrl = sprintf('%s%s', $this->getApiUrl(), $this->apiRoute);

        if (!Url::isValidUrl($requestUrl)) {
            throw new Exception('The combination of apiUrl and apiRoute leads to a non-valid request url.');
        }

        return $requestUrl;
    }

    /**
     * getApiUrl()
     *
     * Returns the current apiUrl.
     *
     * @return string
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * decodeResponseBody()
     *
     * Every response from our API should be a JSON encoded string. This precondition
     * in mind it makes sense to decode every valid responseBody automatically to
     * a php usable structure (objects will be converted to arrays).
     *
     * This method changes nothing if non JSON string was returned.
     *
     * @throws Auth\Exception
     */
    private function decodeResponseBody()
    {
        if (!method_exists($this->lastRequestResponse, 'getResponseHeader')) {
            throw new Auth\Exception('Missing method "getResponseHeader" in class Xtractor\Http\Response.');
        }

        if (!method_exists($this->lastRequestResponse, 'setResponseBody')) {
            throw new Auth\Exception('Missing method "setResponseBody" in class Xtractor\Http\Response.');
        }

        if (!method_exists($this->lastRequestResponse, 'getResponseBody')) {
            throw new Auth\Exception('Missing method "getResponseBody" in class Xtractor\Http\Response.');
        }

        $responseHeader = $this->lastRequestResponse->getResponseHeader();

        if (is_array($responseHeader) &&
          array_key_exists('content-type', $responseHeader) &&
          strtolower($responseHeader['content-type']) === 'application/json'
        ) {
            // Parameter TRUE ensures that every object will be converted to an
            // associative array.
            $decodedResponseBody = json_decode($this->lastRequestResponse->getResponseBody(),
              TRUE);

            if (empty($decodedResponseBody)) {
                throw new Auth\Exception('Error on decoding responseBody, don\'t match with content-type.');
            }

            $this->lastRequestResponse->setResponseBody($decodedResponseBody);
        }
    }
}
