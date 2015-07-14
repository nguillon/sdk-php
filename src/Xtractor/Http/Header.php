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
 * Class Header
 *
 * This class delivers a business object to handle request header in a defined
 * structure.
 *
 * @package Xtractor\Http
 */
class Header
{
    /**
     * @var array
     *
     * Array of current request headers.
     */
    private $fields = array();

    /**
     * __construct()
     *
     * Tells our api server which response types our client can handle and
     * against which api version your application works. Default setting is api
     * 1.0.0, but this can be overwritten with a method in our client\base class.
     */
    public function __construct()
    {
        $this->addField('Accept', 'application/json');
        $this->addField('Accept-Version', '1.0.0');
    }

    /**
     * addField(string $field, string $value)
     *
     * Add new header fields. (e.g. is used for authentication header)
     *
     * @param $field
     * @param $value
     */
    public function addField($field, $value)
    {
        $this->fields[$field] = $value;
    }

    /**
     * getField(string $field)
     *
     * Returns the current value of a field.
     *
     * @param $field
     * @return string
     * @throws Exception
     */
    public function getField($field)
    {
        if (!array_key_exists($field, $this->fields)) {
            throw new Exception('Unknown header field.');
        }

        return (String) $this->fields[$field];
    }

    /**
     * getFieldStrings()
     *
     * Returns an array with all header fields concatenated in following format:
     * <fieldname>:<fieldvalue>
     *
     * @return array
     * @throws Exception
     */
    public function getFieldStrings()
    {
        $fieldStrings = array();

        foreach (array_keys($this->fields) as $field) {
            $fieldStrings[] = $this->getFieldString($field);
        }

        return $fieldStrings;
    }

    /**
     * getFieldString(string $field)
     *
     * Returns a formated string of called field.
     *
     * @param $field
     * @return string
     * @throws Exception
     */
    public function getFieldString($field)
    {
        if (!array_key_exists($field, $this->fields)) {
            throw new Exception('Requested header field not exist.');
        }

        return sprintf('%s: %s', $field, $this->fields[$field]);
    }
}
