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

namespace Xtractor;

require_once realpath(__DIR__ . '/../../vendor/') . '/autoload.php';

use Xtractor\Client\Base;
use Xtractor\Utils\Files;
use Xtractor\Utils\Arrays;


/**
 * Class Client
 *
 * This class is the gateway to our api.
 * Here are all supported api methods declared.
 *
 * @package Xtractor
 */
final class Client extends Base
{
    /**
     * upload(string $filePath[, array $extractors = array())
     *
     * This method uploads a file to our api and returns the response body
     * from that request.
     *
     * A user can define used extractors as an array of strings.
     *
     * @param $filePath
     * @param array $extractors
     * @return array|null
     * @throws Exception
     */
    public function upload($filePath, $extractors = [])
    {
        if (!Files::isValidFilePath($filePath)) {
            throw new Exception('Invalid file path.');
        }

        if (!is_array($extractors)) {
            throw new Exception('Parameter "extractors" must be an array.');
        }

        if (!empty($extractors) && !Arrays::allValuesAreStrings($extractors)) {
            throw new Exception('Every value of parameter "extractors" must be a string.');
        }

        //Set API URL Route
        $this->setApiRoute('/');

        //Set Method
        $this->setRequestMethod('POST');

        //Set Headers
        $this->addHeader('Accept', 'application/json');
        $this->addHeader('X-API-Key', $this->getAccessToken());

        if (!empty($this->getApiVersion())) {
            $this->addHeader('Accept-Version', $this->getApiVersion());
        }

        //Set Body
        $this->addParameter('extractors', $extractors);
        $this->addParameter('file', $filePath);

        //Execute Request
        $response = $this->executeRequest();

        //Return ResultObject
        return $this->buildResultObject($response);
    }
}
