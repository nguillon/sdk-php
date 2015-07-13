<?php
namespace Xtractor\Http;

/**
 * Class Xtractor\Http\Response
 *
 * This class is designed like a business object but includes some methods
 * to parse responses from api.
 */
class Response
{
    /**
     * @var null|string
     */
    private $responseCode = null;
    /**
     * @var null|integer
     */
    private $headerSize = null;
    /**
     * @var null|float
     */
    private $totalTime = null;
    /**
     * @var null|string
     */
    private $rawData = null;
    /**
     * @var array
     */
    private $parsedResult = array();

    /**
     * @param $responseCode
     * @param $headerSize
     * @param $totalTime
     * @param $responseData
     *
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
     * @return null
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /**
     * @param $responseCode
     */
    private function setResponseCode($responseCode)
    {
        $this->responseCode = $responseCode;
    }

    /**
     * @return mixed
     */
    public function getResponseHeader()
    {
        return $this->parsedResult['responseHeader'];
    }

    /**
     * @param $responseHeader
     */
    public function setResponseHeader($responseHeader)
    {
        $this->parsedResult['responseHeader'] = $responseHeader;
    }

    /**
     * @return mixed
     */
    public function getResponseBody()
    {
        return $this->parsedResult['responseBody'];
    }

    /**
     * @param $responseBody
     */
    public function setResponseBody($responseBody)
    {
        $this->parsedResult['responseBody'] = $responseBody;
    }

    /**
     * @param $responseData
     */
    private function setResponseRawData($responseData)
    {
        $this->rawData = $responseData;
    }

    /**
     * @param $headerSize
     */
    private function setHeaderSize($headerSize)
    {
        $this->headerSize = $headerSize;
    }

    /**
     * @param $totalTime
     */
    private function setTotalTime($totalTime)
    {
        $this->totalTime = $totalTime;
    }

    /**
     * @return string
     */
    public function getTotalTime()
    {
        return (String) $this->totalTime;
    }

    /**
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
     * @param $responseHeader
     * @return array
     *
     * Calculates the data typ of given $responseHeader and
     * lead data to the matching parse method.
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
     * @param $rawHeaders
     * @return array
     */
    private function parseStringHeaders($rawHeaders)
    {
        $headers = array();
        $responseHeaderLines = explode("\r\n", $rawHeaders);
        foreach ($responseHeaderLines as $headerLine) {
            if ($headerLine && strpos($headerLine, ':') !== false) {
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
