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
 * Class Response
 *
 * This class is designed like a business object but includes some methods
 * to parse responses from api.
 *
 * @package Xtractor\Http
 */
class Response
{
    /**
     * @var string
     *
     * HTTP Status code from response data delivered by cURL request.
     */
    private $responseCode = null;
    /**
     * @var integer
     *
     * Header size from response data delivered by cURL request.
     */
    private $headerSize = null;
    /**
     * @var float
     *
     * Total time of cURL request.
     */
    private $totalTime = null;
    /**
     * @var string
     *
     * Raw data of cURL response.
     */
    private $rawData = null;
    /**
     * @var array
     *
     * Array of parsed data from cURL response. Splitted in to fields for
     * response header- and response body data.
     */
    private $parsedResult = array();

    /**
     * __construct(intger $responseCode, intger $headerSize, float $totalTime, string $responseData)
     *
     * Constructor sets all required data from cURL response and calls private
     * method parse() to transform response string into a usful structure.
     *
     * @param $responseCode
     * @param $headerSize
     * @param $totalTime
     * @param $responseData
     */
    public function __construct(
      $responseCode,
      $headerSize,
      $totalTime,
      $responseData
    ) {
        $this->setResponseCode($responseCode);
        $this->setHeaderSize($headerSize);
        $this->setTotalTime($totalTime);
        $this->setResponseRawData($responseData);
        $this->parse();
    }

    /**
     * getResponseCode()
     *
     * Returns current response HTTP status code.
     *
     * @return string
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /**
     * setResponseCode($responseCode)
     *
     * Sets response HTTP status code.
     *
     * @param $responseCode
     */
    private function setResponseCode($responseCode)
    {
        $this->responseCode = $responseCode;
    }

    /**
     * getResponseHeader()
     *
     * Returns the parsed response header.
     *
     * @return mixed
     */
    public function getResponseHeader()
    {
        return $this->parsedResult['responseHeader'];
    }

    /**
     * setResponseHeader(array $responseHeader)
     *
     * Sets parsed response header.
     *
     * @param $responseHeader
     */
    private function setResponseHeader($responseHeader)
    {
        $this->parsedResult['responseHeader'] = $responseHeader;
    }

    /**
     * getResponseBody()
     *
     * Returns current response body.
     *
     * @return mixed
     */
    public function getResponseBody()
    {
        return $this->parsedResult['responseBody'];
    }

    /**
     * setResponseBody(mixed $responseBody)
     *
     * Returns the parsed response body.
     *
     * @param $responseBody
     */
    public function setResponseBody($responseBody)
    {
        $this->parsedResult['responseBody'] = $responseBody;
    }

    /**
     * setResponseRawData(string $responseData)
     *
     * Sets the response raw data.
     *
     * @param $responseData
     */
    private function setResponseRawData($responseData)
    {
        $this->rawData = $responseData;
    }

    /**
     * setHeaderSize(integer $headerSize)
     *
     * Sets the responded header size.
     *
     * @param $headerSize
     */
    private function setHeaderSize($headerSize)
    {
        $this->headerSize = $headerSize;
    }

    /**
     * setTotalTime(float $totalTime)
     *
     * Sets the total time of a request.
     *
     * @param $totalTime
     */
    private function setTotalTime($totalTime)
    {
        $this->totalTime = $totalTime;
    }

    /**
     * getTotalTime()
     *
     * Returns the total time of last request as a string.
     *
     * @return string
     */
    public function getTotalTime()
    {
        return (String) $this->totalTime;
    }

    /**
     * parse()
     *
     * This method parses all raw data and set them to class properties.
     */
    private function parse()
    {
        //If we know the header size we can make a clean split in response data.
        if ($this->headerSize) {
            $responseBody = substr($this->rawData, $this->headerSize);
            $responseHeader = substr($this->rawData, 0, $this->headerSize);
        } else {
            //Try to guess the right position for data split.
            $responseSegments = explode("\r\n\r\n", $this->rawData, 2);
            $responseHeader = $responseSegments[0];
            $responseBody = isset($responseSegments[1]) ? $responseSegments[1] : null;
        }

        //Parse response header based on data type
        $parsedResponseHeader = $this->parseHttpResponseHeader($responseHeader);

        $this->setResponseHeader($parsedResponseHeader);
        $this->setResponseBody($responseBody);
    }

    /**
     * parseHttpResponseHeader(mixed $responseHeader)
     *
     * Calculates the data type of given $responseHeader and
     * lead data to the matching parse method.
     *
     * @param $responseHeader
     * @return array
     */
    private function parseHttpResponseHeader($responseHeader)
    {
        if (is_array($responseHeader)) {
            return $this->parseArrayHeaders($responseHeader);
        } else {
            return $this->parseStringHeaders($responseHeader);
        }
    }

    /**
     * parseStringHeaders(string $rawHeaders)
     *
     * This method parses header string. It uses the raw date to split them
     * based on header size value (array[0] => header data,
     * array[1] => response body).
     *
     * @param $rawHeaders
     * @return array
     */
    private function parseStringHeaders($rawHeaders)
    {
        $headers = array();
        $responseHeaderLines = explode("\r\n", $rawHeaders);
        foreach ($responseHeaderLines as $headerLine) {
            if ($headerLine && strpos($headerLine, ':') !== FALSE) {
                list($header, $value) = explode(': ', $headerLine, 2);
                $header = strtolower($header);
                if (isset($headers[$header])) {
                    $headers[$header] .= "\n" . $value;
                } else {
                    $headers[$header] = $value;
                }
            }
        }
        return $headers;
    }

    /**
     * parseArrayHeaders(array $rawHeaders)
     *
     * This method parses header array.
     *
     * @param $rawHeaders
     * @return array
     */
    private function parseArrayHeaders($rawHeaders)
    {
        $header_count = count($rawHeaders);
        $headers = array();

        for ($i = 0; $i < $header_count; $i++) {
            $header = $rawHeaders[$i];

            // Times will have colons in - so we just want the first match.
            $header_parts = explode(': ', $header, 2);
            if (count($header_parts) == 2) {
                $headers[strtolower($header_parts[0])] = $header_parts[1];
            }
        }

        return $headers;
    }
}
