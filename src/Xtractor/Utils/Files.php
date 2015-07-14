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

namespace Xtractor\Utils;

use Xtractor\Utils;

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

    /**
     * isValidFileType(string $filePath)
     *
     * Returns TRUE if the given file path has an supported mime-type,
     * FALSE otherwise.
     *
     * @param $filePath
     * @return bool
     * @throws Utils\Exception
     */
    public static function isValidFileType($filePath)
    {
        $supportedMimeTypes = [
          'application/pdf',
          'image/bmp',
          'image/gif',
          'image/jp2',
          'image/jpeg',
          'image/x-pcx',
          'image/png',
          'image/tiff',
        ];

        if (!self::isValidFilePath($filePath)) {
            throw new Utils\Exception('Invalid file path.');
        }

        return (bool) in_array(self::getMimeType($filePath),
          $supportedMimeTypes);
    }

    /**
     * getMimeType(string $filePath)
     *
     * Returns the mime-type of a given file path.
     *
     * @param $filePath
     * @return string
     * @throws Utils\Exception
     */
    public static function getMimeType($filePath)
    {
        if (!extension_loaded('fileinfo')) {
            throw new Utils\Exception('Required extension "fileinfo" is not enabled.');
        }

        if (!self::isValidFilePath($filePath)) {
            throw new Utils\Exception('Invalid file path.');
        }

        $infoResource = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($infoResource, $filePath);
        finfo_close($infoResource);

        return (String) $mimeType;
    }
}
