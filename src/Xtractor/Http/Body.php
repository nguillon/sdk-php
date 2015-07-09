<?php

if (!class_exists('Xtractor_Client')) {
  require_once dirname(__FILE__) . '/../autoload.php';
}

/**
 * Class Xtractor_Http_Body
 *
 * This class delivers a business object to handle request body in a defined
 * structure.
 */
class Xtractor_Http_Body
{
  /**
   * @var array
   */
  private $_fields = array();

  /**
   * @return array
   */
  public function getFields()
  {
    return $this->_fields;
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
      $this->_fields[$name] = $this->buildCurlFile($value);
    } else {
      if (is_array($value)) {
        $this->_fields[$name] = implode(',', array_map("trim", $value));
      } else {
        $this->_fields[$name] = trim($value);
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
    return Xtractor_Utils_Files::isValidFilePath($value);
  }

  /**
   * @param $filePath
   * @return CURLFile
   * @throws Xtractor_Exception
   */
  private function buildCurlFile($filePath)
  {
    return curl_file_create($filePath, Xtractor_Utils_Files::getMimeType($filePath), basename($filePath));
  }
}
