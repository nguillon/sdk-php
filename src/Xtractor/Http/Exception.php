<?php

if (!class_exists('Xtractor_Client')) {
  require_once dirname(__FILE__) . '/../autoload.php';
}

class Xtractor_Http_Exception extends Xtractor_Exception
{
}
