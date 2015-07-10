<?php
namespace Xtractor\Http;

/**
 * Class Xtractor\Http\Header
 *
 * This class delivers a business object to handle request header in a defined
 * structure.
 */
class Header
{
    /**
     * @var array
     */
    private $fields = array();

    /**
     * Tells our api server which response types our client can handle.
     */
    public function setBaseFields()
    {
        $this->addField('Accept', 'application/json');
        $this->addField('Accept-Version', '1.0.0');
    }

    /**
     * @param $field
     * @param $value
     *
     * Add new header fields. (e.g. is used for authentication header)
     */
    public function addField($field, $value)
    {
        $this->fields[$field] = $value;
    }

    /**
     * @return array
     * @throws Exception
     *
     * Returns an array with all header fields concatenated in following format:
     * <fieldname>:<fieldvalue>
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
     * @param $field
     * @return string
     * @throws Exception
     *
     * Retruns a formated string of called header field.
     */
    public function getFieldString($field)
    {
        if (!array_key_exists($field, $this->fields)) {
            throw new Exception('Requested header field not exist.');
        }

        return sprintf('%s: %s', $field, $this->fields[$field]);
    }
}
