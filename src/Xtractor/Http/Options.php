<?php
namespace Xtractor\Http;

/**
 * Class Xtractor\Http\Options
 *
 * This class delivers a business object to handle request options in a defined
 * structure.
 */
class Options
{
    /**
     * @var array
     */
    private $_options = array();

    /**
     * @param $key
     * @param $value
     *
     * Add a cURL options for later use. (add or override in cURL class)
     */
    public function addOption($key, $value)
    {
        $this->_options[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     * @throws Exception
     *
     * Returns the value of single option.
     */
    public function getOption($key)
    {
        if (!array_key_exists($key, $this->_options)) {
            throw new Exception('Undefined option called.');
        }

        return $this->_options[$key];
    }

    /**
     * @return array
     *
     * Retruns the whole options array.
     */
    public function getAll()
    {
        return $this->_options;
    }
}
