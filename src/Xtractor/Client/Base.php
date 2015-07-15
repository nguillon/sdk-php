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

namespace Xtractor\Client;

use Xtractor\Exception;
use Xtractor\Utils\Url;

use vierbergenlars\SemVer\version;
use GuzzleHttp\Client as GuzzleClient;

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
class Base
{
    private $accessToken = '';
    /**
     * @var string
     *
     * Current request api url
     */
    private $apiUrl = 'https://api.xtractor.io';
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
    private $apiVersion = '1.0.0';

    private $requestMethod = 'GET';

    private $headers = array();

    private $parameters = array();

    private $sslVerification = TRUE;

    public function __construct()
    {

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

        if (empty($accessToken) === TRUE) {
            throw new Exception('Given $accessToken is empty.');
        }

        $this->accessToken = (String) $accessToken;
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
     * setApiUrl(string $apiUrl)
     *
     * During instanciation of client object a user can override default api url.
     * (e.g. we have a complete new url for future api versions or for prod,
     * dev environment)
     *
     * This method ensures a valid url and set them to our class property.
     *
     * @param $apiUrl
     * @throws Exception
     */
    public function setApiUrl($apiUrl)
    {
        $apiUrl = trim($apiUrl);

        if (!Url::isValidUrl($apiUrl)) {
            throw new Exception('Invalid url given.');
        }

        $this->apiUrl = $apiUrl;
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

    public function disableSSLVerification()
    {
        $this->sslVerification = FALSE;
    }

    protected function addHeader($name, $value)
    {
        if (!is_string($name)) {
            throw new Exception('Parametername must be a string.');
        }

        if (!is_string($value)) {
            throw new Exception('Parametervalue must be a string.');
        }

        $this->headers[$name] = $value;
    }

    protected function setParameter($name, $value)
    {
        if (!is_string($name)) {
            throw new Exception('Parametername must be a string.');
        }

        $this->parameters[$name] = $value;
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
        $valid_methods = array('POST', 'GET', 'PUT', 'DELETE');

        if (!in_array($method, $valid_methods)) {
            throw new Exception(sprintf('Invalid method called. - Called: %s',
              $method));
        }

        $this->requestMethod = $method;
    }

    protected function executeRequest()
    {
        if (empty($this->accessToken)) {
            throw new Exception('Missing api key. You have to set them first.');
        }

        $requestClient = $this->getRequestClient();

        switch ($this->requestMethod) {
            case 'POST':
                return $requestClient->post($this->apiRoute,
                  $this->getRequestParameters());
                break;

            case 'PUT':
                return $requestClient->put($this->apiRoute,
                  $this->getRequestParameters());
                break;

            case 'DELETE':
                return $requestClient->delete($this->apiRoute,
                  $this->getRequestParameters());
                break;

            case 'GET':
                return $requestClient->get($this->apiRoute,
                  $this->getRequestParameters());
                break;
        }

    }

    private function getRequestClient()
    {
        $client = new GuzzleClient(
          array(
            'base_uri' => $this->apiUrl,
            'verify' => $this->sslVerification,
            'headers' => $this->headers,
          )
        );

        return $client;
    }

    private function getRequestParameters()
    {
        $requestParameters = array();

        if ($this->requestMethod === 'GET') {

        } else {

        }

        $response = $guzzleClient->post('/', array(
          'multipart' => array(
            array(
              'name' => 'file',
              'contents' => fopen($filePath, 'r'),
            ),
            array(
              'name' => 'extractors',
              'contents' => ''
            )
          )
        ));
    }

    private function buildQueryParameters()
    {

    }
}
