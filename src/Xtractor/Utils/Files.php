<?php
/**
 * xtractor.io-php-sdk
 *
 * PHP Version 5.5.0 or above
 *
 * @copyright 2015 organize.me GmbH (https://www.organize.me)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://xtractor.io
 */

namespace Xtractor\Utils;

use Xtractor\Exception;

/**
 * Class Files
 *
 * This class provides methods with file operations.
 *
 * @package Xtractor\Utils
 */
class Files
{
    /**
     * isValidFilePath(string $filePath)
     *
     * Returns TRUE if the value is an existing file path, FALSE otherwise.
     *
     * @param $filePath
     * @return bool
     */
    public static function isValidFilePath($filePath)
    {
        if (!file_exists($filePath)) {
            return FALSE;
        }

        if (is_dir($filePath)) {
            return FALSE;
        }

        return TRUE;
    }

}
