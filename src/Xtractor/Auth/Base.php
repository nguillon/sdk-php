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

namespace Xtractor\Auth;

use Xtractor\Http;


/**
 * Class Base
 *
 * This class is used to set the authentication header for API calls.
 *
 * @package Xtractor\Auth
 */
class Base
{
    /**
     * @var string
     *
     * This property contains the value of your personal xtractor.io access token.
     * You can sign up and receive a token here: https://console.xtractor.io
     */
    private $accessToken = NULL;
    /**
     * @var Http\Header
     *
     * Current request header object.
     */
    private $header = NULL;

    /**
     * __construct(Header $header)
     *
     * @param Http\Header $header
     */
    public function __construct(Http\Header $header)
    {
        $this->header = $header;
    }

    /**
     * getAccessToken()
     *
     * Returns current access token.
     *
     * @return string
     */
    public function getAccessToken()
    {
        return (String) $this->accessToken;
    }

    /**
     * setAccessToken(string $accessToken)
     *
     * Check the given access token and set them to private class property.
     * After that this value is setted to header object.
     *
     * @param $accessToken
     * @throws Exception
     */
    public function setAccessToken($accessToken)
    {
        $accessToken = trim($accessToken);

        if (empty($accessToken) === TRUE) {
            throw new Exception('Given $accessToken is empty.');
        }

        $this->accessToken = (String) $accessToken;
        $this->setAccessKeyToHeader();
    }

    /**
     * setAccessKeyToHeader()
     *
     * Set current access token to header object. This ensures (if token is
     * known by api) an authenticated request.
     *
     * @throws Exception
     */
    private function setAccessKeyToHeader()
    {
        if (is_null($this->header)) {
            throw new Exception('Missing Xtractor\Http\Header object.');
        }

        $this->header->addField('X-API-Key', $this->getAccessToken());
    }

    /**
     * hasAccessToken()
     *
     * Returns TRUE if the access token value exists, FALSE otherwise.
     *
     * @return bool
     */
    public function hasAccessToken()
    {
        return (is_null($this->accessToken)) ? FALSE : TRUE;
    }
}
