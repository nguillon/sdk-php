<?php

if (!class_exists('Xtractor_Client')) {
  require_once dirname(__FILE__) . '/../autoload.php';
}

class Xtractor_Http_Options
{
  private $_options = array();

  public function addOption($key, $value)
  {
    $this->_options[$key] = $value;
  }

  public function getOption($key)
  {
    if (!array_key_exists($key, $this->_options)) {
      throw new Xtractor_Http_Exception('Undefined option called.');
    }

    return $this->_options[$key];
  }

  public function getAll()
  {
    return $this->_options;
  }
}
