<?php
namespace Xtractor\Http;

use Xtractor\Utils\Files;

/**
 * Class Xtractor\Http\Body
 *
 * This class delivers a business object to handle request body in a defined
 * structure.
 */
class Body
{
    /**
     * @var array
     */
    private $fields = array();

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param $name
     * @param $value
     *
     * Add new field to body object. Values are trimmed and (if array is given)
     * concatenated to a comma separated string.
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
     * @param $value
     * @return bool
     *
     * This method validates if a file is provided in POST request.
     * (e.g. from an upload form field)
     */
    private function isUpload($value)
    {
        return Files::isValidFilePath($value);
    }/** @noinspection PhpUndefinedClassInspection */

    /**
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
