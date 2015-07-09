<?php

/**
 * @param $className
 * @link http://www.php-fig.org/psr/psr-0/
 *
 * This is PSR-0 based autoload method.
 */
function xtractor_api_php_client_autoload($className)
{
  $classPath = explode('_', $className);
  if ($classPath[0] != 'Xtractor') {
    return;
  }
  // Drop 'Xtractor', and maximum class file path depth in this project is 3.
  $classPath = array_slice($classPath, 1, 2);

  $filePath = dirname(__FILE__) . '/' . implode('/', $classPath) . '.php';

  if (file_exists($filePath)) {
    require_once $filePath;
  }
}

spl_autoload_register('xtractor_api_php_client_autoload');
