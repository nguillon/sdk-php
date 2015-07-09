<?php

if (!class_exists('Xtractor_Client')) {
  require_once dirname(__FILE__) . '/../autoload.php';
}

/**
 * Class Xtractor_Http_Options
 *
 * This class delivers a business object to handle request options in a defined
 * structure.
 */
class Xtractor_Http_Options
{
  /**
   * @var array
   */
  private $_options = array();

  /**
   * @param $key
   * @param $value
   *
   * Add a cURL options for later use. (add or override in cURL class)
   */
  public function addOption($key, $value)
  {
    $this->_options[$key] = $value;
  }

  /**
   * @param $key
   * @return mixed
   * @throws Xtractor_Http_Exception
   *
   * Returns the value of single option.
   */
  public function getOption($key)
  {
    if (!array_key_exists($key, $this->_options)) {
      throw new Xtractor_Http_Exception('Undefined option called.');
    }

    return $this->_options[$key];
  }

  /**
   * @return array
   *
   * Retruns the whole options array.
   */
  public function getAll()
  {
    return $this->_options;
  }
}
