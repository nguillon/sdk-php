<?php
/**
 * xtractor.io-php-sdk
 *
 * PHP Version 5.5.0 or above
 *
 * @copyright 2015 organize.me GmbH (https://www.organize.me)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://xtractor.io
 */

namespace Xtractor\Client;

use Xtractor\Exception;
use Xtractor\Utils\Arrays;
use Xtractor\Utils\Files;
use Xtractor\Utils\Url;

use vierbergenlars\SemVer\version;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;

/**
 * Class Base
 *
 * This class contain methods for our client class.
 *
 * We move that methods from our client class to ensure a readable, clean
 * source in that file.
 *
 * @package Xtractor\Client
 */
class Base
{
    private $accessToken = '';
    /**
     * @var string
     *
     * Current request api route
     */
    private $apiRoute = '/';
    /**
     * @var string
     *
     * Version of used api endpoint
     */
    private $apiVersion = '';
    /**
     * @var array
     *
     * Contains all parameters for client creation.
     */
    private $options = [];
    /**
     * @var array
     *
     * Current request parameters
     */
    private $parameters = [];
    /**
     * @var string
     *
     * Current request method
     */
    private $requestMethod = 'GET';

    /**
     * __construct()
     *
     * Set the default api endpoint url.
     */
    public function __construct()
    {
        //Set defaults
        $this->options = [
          'base_uri' => 'https://api.xtractor.io',
        ];
    }

    /**
     * getAccessToken()
     *
     * Returns the current access token.
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * setAccessToken(string $accessToken)
     *
     * Set an access token to the client.
     *
     * @param $accessToken
     * @throws Exception
     */
    public function setAccessToken($accessToken)
    {
        $accessToken = trim($accessToken);

        if (!is_string($accessToken)) {
            throw new Exception('Given $accessToken not a string value.');
        }

        if (empty($accessToken) === true) {
            throw new Exception('Given $accessToken is empty.');
        }

        $this->accessToken = (String) $accessToken;
    }

    /**
     * getApiVersion()
     *
     * Returns the selected api endpoint version.
     *
     * @return string
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    /**
     * setApiVersion(string $apiVersion)
     *
     * Set the used API version. For validation and parsing we use
     * php-semver.
     *
     * @param $apiVersion
     * @throws \vierbergenlars\SemVer\SemVerException
     */
    public function setApiVersion($apiVersion)
    {
        $semVer = new version($apiVersion);
        $this->apiVersion = $semVer->getVersion();
    }

    /**
     * disableSSLVerification()
     *
     * You can disable SSL Verification.
     */
    public function disableSSLVerification()
    {
        $this->options['verify'] = false;
    }

    /**
     * addHeader(string $name, string $value)
     *
     * This method is used to add options to request header. (e.g. we use this
     * method to set access token for authentication)
     *
     * @param $name
     * @param $value
     * @throws Exception
     */
    protected function addHeader($name, $value)
    {
        if (!is_string($name)) {
            throw new Exception('Parameter name must be a string.');
        }

        if (!is_string($value)) {
            throw new Exception('Parameter value must be a string.');
        }

        if (!array_key_exists('headers', $this->options)) {
            $this->options['headers'] = [];
        }

        $this->options['headers'][$name] = $value;
    }

    /**
     * addParameter(string $name, string|array $value)
     *
     * This method is used to set request data. You can use strings or arrays.
     * If you set an array, all values will be concatenated to a comma
     * separated string.
     *
     * @param $name
     * @param $value
     * @throws Exception
     */
    protected function addParameter($name, $value)
    {
        if (!is_string($name)) {
            throw new Exception('Parameter name must be a string.');
        }

        if (!is_array($value) && !is_string($value)) {
            throw new Exception('Parameter value must be a string or an array.');
        }

        $this->parameters[$name] = $value;
    }

    /**
     * buildResultObject(object $response)
     *
     * This method ensures a defined result object.
     *
     * @param $response
     * @return Result
     */
    protected function buildResultObject(Response $response)
    {
        return new Result($response);
    }

    /**
     * getApiUrl()
     *
     * Returns the current apiUrl.
     *
     * @return string
     */
    protected function getApiUrl()
    {
        return $this->options['base_uri'];
    }

    /**
     * setApiUrl(string $apiUrl)
     *
     * During instantiation of client object a user can override default api url.
     * (e.g. we have a complete new url for future api versions or for prod,
     * dev environment)
     *
     * This method ensures a valid url and set them to our class property.
     *
     * @param $apiUrl
     * @throws Exception
     */
    protected function setApiUrl($apiUrl)
    {
        $apiUrl = trim($apiUrl);

        if (!Url::isValidUrl($apiUrl)) {
            throw new Exception('Invalid url given.');
        }

        $this->options['base_uri'] = $apiUrl;
    }

    /**
     * getApiRoute()
     *
     * Returns the current apiRoute.
     *
     * @return string
     */
    protected function getApiRoute()
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
            throw new Exception('Given apiRoute contains whitespaces.');
        }

        $this->apiRoute = trim($apiRoute);
    }

    /**
     * getRequestMethod()
     *
     * Returns the current request method.
     *
     * @return string
     */
    protected function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /**
     * setRequestMethod($method)
     *
     * Set the method for the next request.
     *
     * @param $method
     * @throws Exception
     */
    protected function setRequestMethod($method)
    {
        $method = strtoupper($method);
        $valid_methods = ['POST', 'GET', 'PUT', 'DELETE'];

        if (!in_array($method, $valid_methods)) {
            throw new Exception(sprintf('Invalid method called. - Called: %s',
              $method));
        }

        $this->requestMethod = $method;
    }

    /**
     * executeRequest()
     *
     * This methods executes the request with guzzle library. In the first step
     * the method receives client object. After that we have a switch based on
     * request method to perform the right call.
     *
     * Every request method can handles the request parameters in a different
     * way. For POST,PUT & DELETE we use a parameter array with a multipart
     * structure. For GET request we use a parameter array with a query structure.
     *
     * See also: http://guzzle.readthedocs.org/en/latest/request-options.html#multipart
     * See also: http://guzzle.readthedocs.org/en/latest/request-options.html#query
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws Exception
     */
    protected function executeRequest()
    {
        if (empty($this->accessToken)) {
            throw new Exception('Missing api access token.');
        }

        $requestClient = $this->createRequestClient();
        try {
            switch ($this->requestMethod) {
                case 'POST':
                    return $requestClient->post($this->apiRoute,
                      $this->buildMultipartParameters()
                    );
                    break;

                case 'PUT':
                    return $requestClient->put($this->apiRoute,
                      $this->buildMultipartParameters()
                    );
                    break;

                case 'DELETE':
                    return $requestClient->delete($this->apiRoute,
                      $this->buildMultipartParameters()
                    );
                    break;

                case 'GET':
                    return $requestClient->get($this->apiRoute,
                      $this->buildQueryParameters()
                    );
                    break;

                default:
                    throw new Exception('Cannot execute request. No valid request method found.');
                    break;
            }
        } catch (ClientException $e) {
            return $e->getResponse();
        }
    }

    /**
     * createRequestClient()
     *
     * Returns a guzzle client object with options and headers.
     *
     * @return GuzzleClient
     */
    private function createRequestClient()
    {
        return new GuzzleClient($this->options);
    }

    /**
     * buildMultipartParameters()
     *
     * For POST, PUT & DELETE methods build a parameter structure like this:
     *  'multipart' =>
     *  [
     *      [
     *          'name' => 'parameter name'
     *          'contents' => string|file stream
     *      ]
     *  ]
     *
     * If a parameter value is an array the method transform that to a string.
     * But if you parameter value is an array with nested arrays you will get an
     * error. The only thing that is supported is an array of strings.
     *
     * e.g.
     *  valid: 'param' => array('val1', 'val2', 'val3');
     *  in-valid: 'param' => array(array('val1'), array('val2'), array('val3'));
     *
     * @return array
     * @throws Exception
     */
    private function buildMultipartParameters()
    {
        $parameters = [
          'multipart' => []
        ];

        foreach ($this->parameters as $name => $value) {

            $parameter = [
              'name' => $name,
              'contents' => '',
            ];

            if (is_array($value)) {

                if (!Arrays::allValuesAreStrings($value)) {
                    throw new Exception(sprintf('Every value of given parameter "%s" must be a string.',
                      $name));
                }

                $parameter['contents'] = implode(',',
                  array_map('trim', $value)
                );
            }

            if (is_string($value)) {
                $parameter['contents'] = (Files::isValidFilePath($value)) ? fopen($value,
                  'r') : $value;
            }

            $parameters['multipart'][] = $parameter;
        }

        return $parameters;
    }

    /**
     * buildQueryParameters()
     *
     * GET request just have query parameters. We set that parameters in
     * a structure like this:
     *
     * 'query' =>
     * [
     *  'parameter name' => 'parameter value'
     * ]
     *
     * @return array
     * @throws Exception
     */
    private function buildQueryParameters()
    {
        $parameters = [
          'query' => []
        ];

        foreach ($this->parameters as $name => $value) {

            if (!is_string($value)) {
                throw new Exception('Parameter value is no string. Try to change requestMethod to POST.');
            }

            $parameters['query'][$name] = $value;
        }

        return $parameters;
    }

}
