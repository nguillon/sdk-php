<?php
/**
 * xtractor.io-php-sdk
 *
 * PHP Version 5.5
 *
 * @copyright 2015 organize.me GmbH (http://www.organize.me)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://xtractor.io
 */

/**
 * @param $className
 * @package Xtractor
 * @link http://www.php-fig.org/psr/psr-4/
 *
 * This is PSR-4 based autoload method.
 */

/**
 * xtractor_api_php_client_autoload(string $className)
 *
 * Autoload function based on PSR-4 standard.
 *
 * @param $className
 */
function xtractor_api_php_client_autoload($className)
{
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