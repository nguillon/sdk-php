<?php
namespace Xtractor\Http;

/**
 * Class Xtractor\Http\Request
 *
 * This class delivers a business object to handle requests in a defined
 * structure.
 */
class Request
{
    /**
     * @var string
     */
    private $requestUrl;
    /**
     * @var string
     */
    private $requestMethod = 'GET';
    /**
     * @var Header
     */
    private $requestHeader;
    /**
     * @var Body
     */
    private $requestBody;
    /**
     * @var Options
     */
    private $requestOptions;

    /**
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
     * @return string
     */
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /**
     * @param $requestUrl
     */
    public function setUrl($requestUrl)
    {
        $this->requestUrl = $requestUrl;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->requestUrl;
    }

    /**
     * @param Header $headers
     */
    public function setRequestHeader(Header $headers)
    {
        $this->requestHeader = $headers;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getRequestHeader()
    {
        if (!method_exists($this->requestHeader, 'getFieldStrings')) {
            throw new Exception('Missing method "getFieldStrings" in class Xtractor\Http\Header.');
        }

        return $this->requestHeader->getFieldStrings();
    }

    /**
     * @param Body $body
     */
    public function setRequestBody(Body $body)
    {
        $this->requestBody = $body;
    }

    /**
     * @return mixed
     */
    public function getRequestBody()
    {
        return $this->requestBody;
    }

    /**
     * @param Options $options
     */
    public function setRequestOptions(Options $options)
    {
        $this->requestOptions = $options;
    }

    /**
     * @return mixed
     */
    public function getRequestOptions()
    {
        return $this->requestOptions;
    }
}
