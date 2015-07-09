<?php

if (!class_exists('Xtractor_Client')) {
  require_once dirname(__FILE__) . '/../autoload.php';
}

/**
 * Class Xtractor_Http_Header
 *
 * This class delivers a business object to handle request header in a defined
 * structure.
 */
class Xtractor_Http_Header
{
  /**
   * @var array
   */
  private $_headers = array();

  /**
   * Tells our api server which response types our client can handle.
   */
  public function setBaseFields()
  {
    $this->addField('Accept', 'application/json');
    $this->addField('Accept-Version', '1.0.0');
  }

  /**
   * @param $field
   * @param $value
   *
   * Add new header fields. (e.g. is used for authentication header)
   */
  public function addField($field, $value)
  {
    $this->_headers[$field] = $value;
  }

  /**
   * @return array
   * @throws Xtractor_Http_Exception
   *
   * Returns an array with all header fields concatenated in following format:
   * <fieldname>:<fieldvalue>
   */
  public function getFieldStrings()
  {
    $fieldStrings = array();

    foreach(array_keys($this->_headers) as $field) {
      $fieldStrings[] = $this->getFieldString($field);
    }

    return $fieldStrings;
  }

  /**
   * @param $field
   * @return string
   * @throws Xtractor_Http_Exception
   *
   * Retruns a formated string of called header field.
   */
  public function getFieldString($field)
  {
    if (!array_key_exists($field, $this->_headers)) {
      throw new Xtractor_Http_Exception('Requested header field not exist.');
    }

    return sprintf('%s: %s', $field, $this->_headers[$field]);
  }
}
