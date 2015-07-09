<?php

if (!class_exists('Xtractor_Client')) {
  require_once dirname(__FILE__) . '/../autoload.php';
}

/**
 * Class Xtractor_Auth_Exception
 *
 * This class is used to throw more specifc exceptions. You can handle
 * them differently.
 */
class Xtractor_Auth_Exception extends Xtractor_Exception
{

}
