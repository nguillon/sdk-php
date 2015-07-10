<?php

/**
 * @param $className
 * @link http://www.php-fig.org/psr/psr-4/
 *
 * This is PSR-4 based autoload method.
 */
function xtractor_api_php_client_autoload($className) {
  $prefix = 'Xtractor\\';

  $base_dir = __DIR__ . '/';
  $len = strlen($prefix);

  if (strncmp($prefix, $className, $len) !== 0) {
    return;
  }

  $relative_class = substr($className, $len);

  $filePath = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

  if (file_exists($filePath)) {
    require_once $filePath;
  }
}

spl_autoload_register('xtractor_api_php_client_autoload');