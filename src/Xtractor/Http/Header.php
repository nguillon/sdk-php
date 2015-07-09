<?php

if (!class_exists('Xtractor_Client')) {
  require_once dirname(__FILE__) . '/../autoload.php';
}

class Xtractor_Http_Header
{
  private $_headers = array();

  public function setBaseFields()
  {
    $this->addField('Accept', 'application/json');
    $this->addField('Accept-Version', '1.0.0');
  }

  public function addField($field, $value)
  {
    $this->_headers[$field] = $value;
  }

  public function getFieldStrings()
  {
    $fieldStrings = array();

    foreach(array_keys($this->_headers) as $field) {
      $fieldStrings[] = $this->getFieldString($field);
    }

    return $fieldStrings;
  }

  public function getFieldString($field)
  {
    if (!array_key_exists($field, $this->_headers)) {
      throw new Xtractor_Http_Exception('Requested header field not exist.');
    }

    return sprintf('%s: %s', $field, $this->_headers[$field]);
  }
}
