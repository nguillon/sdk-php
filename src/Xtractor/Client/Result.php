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
use GuzzleHttp\Psr7\Response;

class Result
{
    /**
     * @var mixed
     *
     * Contains resultdata of a response
     */
    private $data = null;

    private $errorCode = null;

    private $errorMessage = '';

    public function __construct(Response $response)
    {
        $this->analyseResponse($response);
    }

    /**
     * analyseResponse(Response $response)
     *
     * In the first step we check if the status code of our response has an
     * error. If it is TRUE we set an error object.
     *
     * Otherwise we check the response body and decode them. We assume that
     * out api only responde JSOn encoded results.
     *
     * @param $response
     * @throws Exception
     */
    private function analyseResponse(Response $response)
    {
        //Set a error if something with HTTP connection fails
        if ($response->getStatusCode() !== 200) {
            $this->setError(
              $response->getStatusCode(),
              $response->getReasonPhrase()
            );
        }

        //If everything seems ok we go deeper and analyse the response data
        if (!$this->hasError()) {
            $responseBody = $response->getBody()->getContents();
            $contentType = $response->getHeader('Content-Type');

            if (empty($contentType) || $contentType[0] != 'application/json') {
                $this->setError(
                  500,
                  'Invalid response from api.'
                );
            } else {
                $this->data = $this->decodeJSON($responseBody);
            }
        }
    }

    /**
     * setError(string $code, string $message)
     *
     * Set an occured error.
     *
     * @param $code
     * @param $message
     */
    private function setError($code, $message)
    {
        $this->errorCode = $code;
        $this->errorMessage = $message;
    }

    /**
     * hasError()
     *
     * Returns TRUE if an error occured, otherwise FALSE.
     *
     * @return bool
     */
    public function hasError()
    {
        return (!is_null($this->errorCode)) ? true : false;
    }

    /**
     * decodeJSON(string $string)
     *
     * This methods decodes JSON string to an associative array. If this given
     * string is non valid JSON the return value is empty.
     *
     * @param $string
     * @return null|array
     * @throws Exception
     */
    protected function decodeJSON($string)
    {
        if (!is_string($string)) {
            throw new Exception('Given parameter must be a string value.');
        }

        return json_decode($string, true);
    }

    /**
     * getError()
     *
     * Returns an error object with current error code and error message.
     *
     * @return StdClass
     */
    public function getError()
    {
        $error = new \StdClass();
        $error->code = $this->getErrorCode();
        $error->message = $this->getErrorMessage();

        return $error;
    }

    /**
     * getErrorCode()
     *
     * Returns just the error code.
     *
     * @return null
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * getErrorMessage()
     *
     * Returns just the error message.
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * getData()
     *
     * Returns the response data.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}
