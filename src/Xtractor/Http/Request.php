<?php
/**
 * xtractor.io-php-sdk
 *
 * PHP Version 5.3
 *
 * @copyright 2015 organize.me GmbH (https://www.organize.me)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://xtractor.io
 */

namespace Xtractor\Http;

/**
 * Class Request
 *
 * This class delivers a business object to handle requests in a defined
 * structure.
 *
 * @package Xtractor\Http
 */
class Request
{
    /**
     * @var string
     *
     * Current request url.
     */
    private $requestUrl;
    /**
     * @var string
     *
     * Current request method.
     */
    private $requestMethod = 'GET';
    /**
     * @var Header
     *
     * Current request header object.
     */
    private $requestHeader;
    /**
     * @var Body
     *
     * Current request body object.
     */
    private $requestBody;
    /**
     * @var Options
     *
     * Current request options object.
     */
    private $requestOptions;

    /**
     * setRequestMethod(string $method)
     *
     * Sets the request methos. Ensures only supported methods.
     *
     * @param $method
     * @throws Exception
     */
    public function setRequestMethod($method)
    {
        $method = strtoupper($method);
        $valid_methods = array('POST', 'GET', 'PUT', 'DELETE');

        if (!in_array($method, $valid_methods)) {
            throw new Exception(sprintf('Invalid method called. - Called: %s',
              $method));
        }

        $this->requestMethod = $method;
    }

    /**
     * getRequestMethod()
     *
     * Returns current request method.
     *
     * @return string
     */
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /**
     * setUrl(string $requestUrl)
     *
     * Set the request url.
     *
     * @param $requestUrl
     */
    public function setUrl($requestUrl)
    {
        $this->requestUrl = $requestUrl;
    }

    /**
     * getUrl()
     *
     * Returns the current request url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->requestUrl;
    }

    /**
     * setRequestHeader(Header $headers)
     *
     * Sets a header object to request.
     *
     * @param Header $headers
     */
    public function setRequestHeader(Header $headers)
    {
        $this->requestHeader = $headers;
    }

    /**
     * getRequestHeader()
     *
     * Returns current header object.
     *
     * @return Header
     */
    public function getRequestHeader()
    {
        return $this->requestHeader;
    }

    /**
     * getRequestHeaderFields()
     *
     * Returns the current header object formated as an array of
     * header field strings.
     *
     * @return array
     * @throws Exception
     */
    public function getRequestHeaderFields()
    {
        if (!method_exists($this->requestHeader, 'getFieldStrings')) {
            throw new Exception('Missing method "getFieldStrings" in class Xtractor\Http\Header.');
        }

        return $this->requestHeader->getFieldStrings();
    }

    /**
     * setRequestBody(Body $body)
     *
     * Sets a body object to request.
     *
     * @param Body $body
     */
    public function setRequestBody(Body $body)
    {
        $this->requestBody = $body;
    }

    /**
     * getRequestBody()
     *
     * Returns current body object.
     *
     * @return Body
     */
    public function getRequestBody()
    {
        return $this->requestBody;
    }

    /**
     * setRequestOptions(Options $options)
     *
     * Sets a options object to request.
     *
     * @param Options $options
     */
    public function setRequestOptions(Options $options)
    {
        $this->requestOptions = $options;
    }

    /**
     * getRequestOptions()
     *
     * Returns current body object.
     *
     * @return Options
     */
    public function getRequestOptions()
    {
        return $this->requestOptions;
    }
}
