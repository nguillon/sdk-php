<?php
namespace Xtractor\Auth;

use Xtractor\Http;

/**
 * Class Xtractor\Auth\Base
 *
 * This class is used to set the authentication header for API calls.
 */
class Base
{
    /**
     * @var String
     */
    private $accessToken = null;
    /**
     * @var Http\Header
     */
    private $header = null;

    /**
     * @param Http\Header $header
     */
    public function __construct(Http\Header $header)
    {
        $this->header = $header;
    }

    /**
     * @param $accessToken
     * @throws Exception
     *
     * Checks the given access token and set them to class property to use them
     * in class methods.
     *
     * After that this value is setted to header object.
     */
    public function setAccessToken($accessToken)
    {
        $accessToken = trim($accessToken);

        if (empty($accessToken) === true) {
            throw new Exception('Given $code is empty.');
        }

        $this->accessToken = (String) $accessToken;
        $this->setAccessKeyToHeader();
    }

    /**
     * @return null
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @return bool
     *
     * Checks if an access token is set.
     */
    public function hasAccessToken()
    {
        return (is_null($this->accessToken)) ? false : true;
    }

    /**
     * @throws Exception
     *
     * Sets current access token to header object. This ensures (if token is
     * known by api) an authenticated request.
     */
    private function setAccessKeyToHeader()
    {
        if (is_null($this->header)) {
            throw new Exception('Missing Xtractor\Http\Header object.');
        }

        $this->header->addField('X-API-Key', $this->getAccessToken());
    }
}
