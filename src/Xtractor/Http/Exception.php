<?php

if (!class_exists('Xtractor_Client')) {
  require_once dirname(__FILE__) . '/../autoload.php';
}

/**
 * Class Xtractor_Http_Exception
 *
 * This class is used to throw more specifc exceptions. You can handle
 * them differently.
 */
class Xtractor_Http_Exception extends Xtractor_Exception
{
}
