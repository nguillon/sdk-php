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

namespace Xtractor\Http;

/**
 * Class Options
 *
 * This class delivers a business object to handle request options in a defined
 * structure.
 *
 * @package Xtractor\Http
 */
class Options
{
    /**
     * @var array
     *
     * Contains all user defined options for the request.
     */
    private $options = array();

    /**
     * addOption(string $key, mixed $value)
     *
     * Add a cURL options for later use. (add or override in cURL class)
     *
     * @param $key
     * @param $value
     */
    public function addOption($key, $value)
    {
        $this->options[$key] = $value;
    }

    /**
     * getOption(string $key)
     *
     * Returns the value of single option.
     *
     * @param $key
     * @return mixed
     * @throws Exception
     */
    public function getOption($key)
    {
        if (!array_key_exists($key, $this->options)) {
            throw new Exception('Unknown option called.');
        }

        return $this->options[$key];
    }

    /**
     * getAll()
     *
     * Returns the whole options array.
     *
     * @return array
     */
    public function getAll()
    {
        return $this->options;
    }
}
