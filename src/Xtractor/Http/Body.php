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

use Xtractor\Utils\Files;

/**
 * Class Body
 *
 * This class delivers a business object to handle request body in a defined
 * structure.
 *
 * @package Xtractor\Http
 */
class Body
{
    /**
     * @var array
     *
     * Array of request options.
     */
    private $fields = array();

    /**
     * getFields()
     *
     * Returns an array of current request option fields.
     *
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * addField(string $name, string $value)
     *
     * Add new field to body object. Values are trimmed and (if array is given)
     * concatenated to a comma separated string.
     *
     * @param $name
     * @param $value
     */
    public function addField($name, $value)
    {
        if (is_string($value) && $this->isUpload($value)) {
            $this->fields[$name] = $this->buildCurlFile($value);
        } else {
            if (is_array($value)) {
                $this->fields[$name] = implode(',', array_map("trim", $value));
            } else {
                $this->fields[$name] = trim($value);
            }
        }
    }

    /**
     * isUpload(string $value)
     *
     * This method checks a given string if the content is a valid filepath.
     * We use this check to decide if we have to create a cURLFile object.
     *
     * @param $value
     * @return bool
     */
    private function isUpload($value)
    {
        return Files::isValidFilePath($value);
    }

    /**
     * buildCurlFile(string $filePath)
     *
     * This method creates a cURLFile object that is required when a user want
     * to upload a local file to our server.
     *
     * @param $filePath
     * @return CURLFile
     * @throws Exception
     */
    private function buildCurlFile($filePath)
    {
        return curl_file_create($filePath, Files::getMimeType($filePath),
          basename($filePath));
    }
}
