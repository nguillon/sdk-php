<?php

if (!class_exists('Xtractor_Client')) {
  require_once dirname(__FILE__) . '/../autoload.php';
}

class Xtractor_Http_Body
{
  private $_fields = array();

  public function getFields()
  {
    return $this->_fields;
  }

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

  private function isUpload($value)
  {
    return Xtractor_Utils_Files::isValidFilePath($value);
  }

  private function buildCurlFile($filePath)
  {
    return curl_file_create($filePath, Xtractor_Utils_Files::getMimeType($filePath), basename($filePath));
  }
}
