<?php
/**
 * xtractor.io-php-sdk
 *
 * PHP Version 5.3
 *
 * @copyright 2015 organize.me GmbH (https://www.organize.me)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://xtractor.io
 */

namespace Xtractor\Utils;

/**
 * Class Array
 *
 * This class provides methods to handle array operations.
 *
 * @package Xtractor\Utils
 */
class Arrays
{
    /**
     * allValuesAreStrings(array $array)
     *
     * Checks if every value of an array is a string type.
     *
     * @param array $array
     * @return bool
     */
    public static function allValuesAreStrings(Array $array)
    {
        foreach($array as $value) {
            if (!is_string($value)) {
                return FALSE;
            }
        }

        return TRUE;
    }
}
