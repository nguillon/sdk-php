<?php
/**
 * PhoneInfo
 *
 * PHP version 5
 *
 * @category Class
 * @package  Organizeme\Xtractor
 * @author   http://github.com/swagger-api/swagger-codegen
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link     https://github.com/swagger-api/swagger-codegen
 */
/**
 *  Copyright 2015 SmartBear Software
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Organizeme\Xtractor\Models;

use \ArrayAccess;
/**
 * PhoneInfo Class Doc Comment
 *
 * @category    Class
 * @description 
 * @package     Organizeme\Xtractor
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class PhoneInfo implements ArrayAccess
{
    /**
      * Array of property to type mappings. Used for (de)serialization 
      * @var string[]
      */
    static $swaggerTypes = array(
        'phone_type' => 'string',
        'country' => 'string',
        'number' => 'string'
    );
  
    /** 
      * Array of attributes where the key is the local name, and the value is the original name
      * @var string[] 
      */
    static $attributeMap = array(
        'phone_type' => 'phone_type',
        'country' => 'country',
        'number' => 'number'
    );
  
    /**
      * Array of attributes to setter functions (for deserialization of responses)
      * @var string[]
      */
    static $setters = array(
        'phone_type' => 'setPhoneType',
        'country' => 'setCountry',
        'number' => 'setNumber'
    );
  
    /**
      * Array of attributes to getter functions (for serialization of requests)
      * @var string[]
      */
    static $getters = array(
        'phone_type' => 'getPhoneType',
        'country' => 'getCountry',
        'number' => 'getNumber'
    );
  
    
    /**
      * $phone_type Fax or phone.
      * @var string
      */
    protected $phone_type;
    
    /**
      * $country 2-letter country code (ISO 3166).
      * @var string
      */
    protected $country;
    
    /**
      * $number Normalized phone number.
      * @var string
      */
    protected $number;
    

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initalizing the model
     */
    public function __construct(array $data = null)
    {
        if ($data != null) {
            $this->phone_type = $data["phone_type"];
            $this->country = $data["country"];
            $this->number = $data["number"];
        }
    }
    
    /**
     * Gets phone_type
     * @return string
     */
    public function getPhoneType()
    {
        return $this->phone_type;
    }
  
    /**
     * Sets phone_type
     * @param string $phone_type Fax or phone.
     * @return $this
     */
    public function setPhoneType($phone_type)
    {
        $allowed_values = array("FAX", "PHONE");
        if (!in_array($phone_type, $allowed_values)) {
            throw new \InvalidArgumentException("Invalid value for 'phone_type', must be one of 'FAX', 'PHONE'");
        }
        $this->phone_type = $phone_type;
        return $this;
    }
    
    /**
     * Gets country
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }
  
    /**
     * Sets country
     * @param string $country 2-letter country code (ISO 3166).
     * @return $this
     */
    public function setCountry($country)
    {
        
        $this->country = $country;
        return $this;
    }
    
    /**
     * Gets number
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }
  
    /**
     * Sets number
     * @param string $number Normalized phone number.
     * @return $this
     */
    public function setNumber($number)
    {
        
        $this->number = $number;
        return $this;
    }
    
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset 
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }
  
    /**
     * Gets offset.
     * @param  integer $offset Offset 
     * @return mixed 
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }
  
    /**
     * Sets value based on offset.
     * @param  integer $offset Offset 
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }
  
    /**
     * Unsets offset.
     * @param  integer $offset Offset 
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }
  
    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) {
            return json_encode(get_object_vars($this), JSON_PRETTY_PRINT);
        } else {
            return json_encode(get_object_vars($this));
        }
    }
}
