<?php
namespace Xtractor\Client;

use Xtractor\Auth;
use Xtractor\Http;
use Xtractor\IO\Curl;

/**
 * Class Xtractor\Client\Base
 */
class Base extends Auth\Base
{
    /**
     * @var string
     */
    private $_defaultApiUrl = 'https://api.xtractor.io';
    /**
     * @var null|string
     */
    private $_apiUrl = null;
    /**
     * @var null|Http\Request
     */
    private $_request = null;
    /**
     * @var null|Http\Response
     */
    private $_last_request_response = null;

    /**
     * @var null|Http\Header
     */
    protected $_header = null;
    /**
     * @var null|Http\Body
     */
    protected $_body = null;
    /**
     * @var null|Http\Options
     */
    protected $_options = null;

    /**
     * @param null $apiUrl
     */
    public function __construct($apiUrl = null)
    {
        //Init objects
        $this->_request = new Http\Request();
        $this->_header = new Http\Header();
        $this->_body = new Http\Body();
        $this->_options = new Http\Options();

        //Set defaults
        $this->_setApiUrl($apiUrl);
        $this->_header->setBaseFields();

        //Parent Constructor
        parent::__construct($this->_header);
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
        $this->_request->setRequestMethod($method);
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

        $this->_request->setUrl($this->_apiUrl);
        $this->_request->setRequestHeader($this->_header);
        $this->_request->setRequestBody($this->_body);
        $this->_request->setRequestOptions($this->_options);

        $this->_last_request_response = $xtractorIoCurl->executeRequest($this->_request);
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
     * @throws Auth\Exception
     */
    private function decodeResponseBody()
    {
        if (!method_exists($this->_last_request_response,
          'getResponseHeader')
        ) {
            throw new Auth\Exception('Missing method "getResponseHeader" in class Xtractor\Http\Response.');
        }

        if (!method_exists($this->_last_request_response, 'setResponseBody')) {
            throw new Auth\Exception('Missing method "setResponseBody" in class Xtractor\Http\Response.');
        }

        if (!method_exists($this->_last_request_response, 'getResponseBody')) {
            throw new Auth\Exception('Missing method "getResponseBody" in class Xtractor\Http\Response.');
        }

        $responseHeader = $this->_last_request_response->getResponseHeader();

        if (is_array($responseHeader) &&
          array_key_exists('content-type', $responseHeader) &&
          strtolower($responseHeader['content-type']) === 'application/json'
        ) {
            // Parameter TRUE ensues that every object will be converted to an
            // associative array.
            $decodedResponseBody = json_decode($this->_last_request_response->getResponseBody(),
              true);

            if (empty($decodedResponseBody)) {
                throw new Auth\Exception('Error on decoding responseBody, don\'t match with content-type.');
            }

            $this->_last_request_response->setResponseBody($decodedResponseBody);
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
    private function _setApiUrl($apiUrl)
    {
        if (!is_null($apiUrl)) {
            /** @noinspection PhpUndefinedClassInspection */
            if (Url::isValidUrl($this->_apiUrl)) {
                $this->_apiUrl = trim($apiUrl);
            } else {
                $this->_apiUrl = $this->_defaultApiUrl;
            }
        } else {
            $this->_apiUrl = $this->_defaultApiUrl;
        }
    }

}
