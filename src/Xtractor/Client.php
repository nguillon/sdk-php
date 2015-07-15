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
     * __construct([string $apiUrl = NULL])
     *
     * A user can overwrite default api url. Further explanations:
     * Xtractor\Client\Base::_setApiUrl
     *
     * @param null $apiUrl
     */
    public function __construct($apiUrl = NULL)
    {
        parent::__construct($apiUrl);
    }

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
     * @throws Exception
     */
    public function upload($filePath, $extractors = array())
    {
        if (!Files::isValidFilePath($filePath)) {
            throw new Exception('Invalid file path.');
        }

        if (!is_array($extractors)) {
            throw new Exception('Parameter "extractors" must be an array.');
        }

        if (!empty($extractors) && !Arrays::allValuesAreStrings($extractors)) {
            throw new Exception('Every value of parameter "extractors" must be an array.');
        }

        //Set API URL Route
        $this->setApiRoute('/');

        //Set Method
        $this->setRequestMethod('POST');

        //Set Headers
        $this->addHeader('Accept', 'application/json');
        $this->addHeader('Accept-Version', $this->getApiVersion());
        $this->addHeader('X-API-Key', $this->getAccessToken());

        //Set Body
        $this->setBodyParameter('extractors', $extractors);
        $this->setBodyParameter('file', $filePath);

        //Execute Request
        $respone = $this->executeRequest();
        return $respone->getBody()->getContents();
    }
}
