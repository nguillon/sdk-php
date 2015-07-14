<?php
/**
 * xtractor.io-php-sdk
 *
 * PHP Version 5.5
 *
 * @copyright 2015 organize.me GmbH (http://www.organize.me)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://xtractor.io
 */

namespace Xtractor;

use Xtractor\Client\Base;
use Xtractor\Utils\Files;

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
     * @return Http\Response
     * @throws Auth\Exception
     * @throws Exception
     * @throws Utils\Exception
     */
    public function upload($filePath, $extractors = array())
    {
        if (!Files::isValidFileType($filePath)) {
            throw new Exception('Invalid file type.');
        }

        if (!is_array($extractors)) {
            throw new Exception('Option "extractors" have to be an array.');
        }

        //Set URL Route
        $this->setApiRoute('/');

        //Set Method
        $this->setRequestMethod('POST');

        //Set Postfields
        $this->body->addField('extractors', $extractors);
        $this->body->addField('file', $filePath);

        //Set Options
        $this->options->addOption(CURLOPT_SSL_VERIFYPEER, FALSE);
        $this->options->addOption(CURLOPT_CONNECTTIMEOUT, 60);
        $this->options->addOption(CURLOPT_TIMEOUT, 60);

        return $this->executeRequest();
    }
}
