<?php
namespace Xtractor\Client;

use Xtractor\Auth;
use Xtractor\Exception;
use Xtractor\Http;
use Xtractor\Utils\Url;
use Xtractor\IO\Curl;

/**
 * Class Xtractor\Client\Base
 */
class Base extends Auth\Base
{
    /**
     * @var string
     */
    private $defaultApiUrl = 'https://api.xtractor.io';
    /**
     * @var null|string
     */
    private $apiUrl = null;

    /**
     * @var string
     */
    private $apiRoute = '/';

    /**
     * @var null|Http\Request
     */
    private $request = null;
    /**
     * @var null|Http\Response
     */
    private $lastRequestResponse = null;

    /**
     * @var null|Http\Header
     */
    protected $header = null;
    /**
     * @var null|Http\Body
     */
    protected $body = null;
    /**
     * @var null|Http\Options
     */
    protected $options = null;

    /**
     * @param null $apiUrl
     */
    public function __construct($apiUrl = null)
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
     * @param $apiVersion
     * @throws \Xtractor\Exception
     *
     * Sets the used API version.
     */
    public function setAPIVersion($apiVersion)
    {
        if (!preg_match('/^(\d{1,2}\.\d{1,2}\.\d{1,2}){1}$/i', $apiVersion)) {
            throw new Exception('Malformed API-Version string.');
        }

        $this->header->addField('Accept-Version', $apiVersion);
    }

    /**
     * @return mixed
     * @throws Http\Exception
     *
     * Returns the current set API version.
     */
    public function getAPIVersion()
    {
        return $this->header->getField('Accept-Version');
    }

    /**
     * @param $method
     * @throws Http\Exception
     *
     * Sets the reuqes method to request object. Actually only the method "POST"
     * makes a different, because in this case we need to set CURLOPT_POSTFIELDS
     * during cURL request.
     */
    protected function setRequestMethod($method)
    {
        $this->request->setRequestMethod($method);
    }

    /**
     * @return Http\Response
     * @throws Auth\Exception
     * @throws Http\Exception
     *
     * This method sets the required values and objects to the §request instance
     * and execute request.
     */
    protected function executeRequest()
    {
        if (!$this->hasAccessToken()) {
            throw new Auth\Exception('Missing api key. You have to set them first.');
        }

        $xtractorIoCurl = new Curl();

        $this->request->setUrl($this->apiUrl);
        $this->request->setRequestHeader($this->header);
        $this->request->setRequestBody($this->body);
        $this->request->setRequestOptions($this->options);

        $this->lastRequestResponse = $xtractorIoCurl->executeRequest($this->request);
        $this->decodeResponseBody();

        return $this->lastRequestResponse;
    }

    /**
     * Every response from our API should be a JSON encoded string. This precondition
     * in mind it makes sense to decode every valid responseBody automatically to
     * a php usable structure (objects will be converted to arrays).
     *
     * This method works silently if no json content was returned.
     *
     * @throws Auth\Exception
     */
    private function decodeResponseBody()
    {
        if (!method_exists($this->lastRequestResponse,
          'getResponseHeader')
        ) {
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
            // Parameter TRUE ensues that every object will be converted to an
            // associative array.
            $decodedResponseBody = json_decode($this->lastRequestResponse->getResponseBody(),
              true);

            if (empty($decodedResponseBody)) {
                throw new Auth\Exception('Error on decoding responseBody, don\'t match with content-type.');
            }

            $this->lastRequestResponse->setResponseBody($decodedResponseBody);
        }
    }

    /**
     * @param $apiUrl
     *
     * During instanciation of client object a user can override default api url.
     * (e.g. we have a complete new url for future api versions or for
     *  prod,dev environment)
     *
     * This method ensures a valid url and set them to our class property.
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
     * @return null|string
     *
     * Returns the current apiUrl.
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * @param $apiRoute
     * @throws Exception
     *
     * This method helps to specify the correct rout against our REST API.
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
     * @return string
     *
     * Returns the current apiRoute.
     */
    public function getApiRoute()
    {
        return $this->apiRoute;
    }
}
