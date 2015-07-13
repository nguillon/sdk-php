<?php
namespace Xtractor;

use Xtractor\Client\Base;
use Xtractor\Utils\Files;

/**
 * Class Xtractor\Client
 *
 * This class is the gateway to our api.
 * Here are all supported api methods declared.
 */
final class Client extends Base
{
    /**
     * @param null $apiUrl
     *
     * A user can override default api url. Further explanations:
     * Xtractor\Client\Base::_setApiUrl
     */
    public function __construct($apiUrl = null)
    {
        parent::__construct($apiUrl);
    }

    /**
     * @param $filePath
     * @param array $extractors
     * @return \Xtractor\Http\Response
     * @throws Exception
     * @throws Http\Exception
     *
     * This method uploads a file to our api and returns the response body
     * from that request.
     *
     * A user can define used extractors as an array of strings.
     */
    public function upload($filePath, $extractors = array())
    {
        if (!Files::isValidFileType($filePath)) {
            throw new Exception('Invalid file type.');
        }

        //Set URL Route
        $this->setApiRoute('/');

        //Set Method
        $this->setRequestMethod('POST');

        //Set Postfields
        $this->body->addField('extractors', $extractors);
        $this->body->addField('file', $filePath);

        //Set Options
        $this->options->addOption(CURLOPT_SSL_VERIFYPEER, false);
        $this->options->addOption(CURLOPT_CONNECTTIMEOUT, 60);
        $this->options->addOption(CURLOPT_TIMEOUT, 60);

        return $this->executeRequest();
    }
}
