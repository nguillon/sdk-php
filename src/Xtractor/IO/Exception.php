<?php

if (!class_exists('Xtractor_Client')) {
  require_once dirname(__FILE__) . '/../autoload.php';
}

/**
 * Class Xtractor_IO_Exception
 *
 * This class is used to throw more specifc exceptions. You can handle
 * them differently.
 */
class Xtractor_IO_Exception extends Xtractor_Exception
{
}
