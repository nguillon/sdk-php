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

/**
 * Class Url
 *
 * This class provides methods to handle url strings.
 *
 * @package Xtractor\Utils
 */
class Url
{
    /**
     * isValidUrl(string $url)
     *
     * Returns TRUE if the value is a valid url, FALSE otherwise.
     *
     * @param $url
     * @return bool
     *
     * @package Xtractor\Utils
     */
    public static function isValidUrl($url)
    {
        $url = trim($url);

        if (empty($url)) {
            return FALSE;
        }

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return FALSE;
        }

        return TRUE;
    }
}
