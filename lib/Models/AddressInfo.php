<?php
/**
 * AddressInfo
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
 * AddressInfo Class Doc Comment
 *
 * @category    Class
 * @description 
 * @package     Organizeme\Xtractor
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class AddressInfo implements ArrayAccess
{
    /**
      * Array of property to type mappings. Used for (de)serialization 
      * @var string[]
      */
    static $swaggerTypes = array(
        'header' => 'string',
        'subheader' => 'string',
        'street' => 'string',
        'postal_code' => 'string',
        'city' => 'string'
    );
  
    /** 
      * Array of attributes where the key is the local name, and the value is the original name
      * @var string[] 
      */
    static $attributeMap = array(
        'header' => 'header',
        'subheader' => 'subheader',
        'street' => 'street',
        'postal_code' => 'postal_code',
        'city' => 'city'
    );
  
    /**
      * Array of attributes to setter functions (for deserialization of responses)
      * @var string[]
      */
    static $setters = array(
        'header' => 'setHeader',
        'subheader' => 'setSubheader',
        'street' => 'setStreet',
        'postal_code' => 'setPostalCode',
        'city' => 'setCity'
    );
  
    /**
      * Array of attributes to getter functions (for serialization of requests)
      * @var string[]
      */
    static $getters = array(
        'header' => 'getHeader',
        'subheader' => 'getSubheader',
        'street' => 'getStreet',
        'postal_code' => 'getPostalCode',
        'city' => 'getCity'
    );
  
    
    /**
      * $header Name.
      * @var string
      */
    protected $header;
    
    /**
      * $subheader Second part of name (can be null).
      * @var string
      */
    protected $subheader;
    
    /**
      * $street Street name and number or postbox (can be null).
      * @var string
      */
    protected $street;
    
    /**
      * $postal_code Postal code.
      * @var string
      */
    protected $postal_code;
    
    /**
      * $city City.
      * @var string
      */
    protected $city;
    

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initalizing the model
     */
    public function __construct(array $data = null)
    {
        if ($data != null) {
            $this->header = $data["header"];
            $this->subheader = $data["subheader"];
            $this->street = $data["street"];
            $this->postal_code = $data["postal_code"];
            $this->city = $data["city"];
        }
    }
    
    /**
     * Gets header
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }
  
    /**
     * Sets header
     * @param string $header Name.
     * @return $this
     */
    public function setHeader($header)
    {
        
        $this->header = $header;
        return $this;
    }
    
    /**
     * Gets subheader
     * @return string
     */
    public function getSubheader()
    {
        return $this->subheader;
    }
  
    /**
     * Sets subheader
     * @param string $subheader Second part of name (can be null).
     * @return $this
     */
    public function setSubheader($subheader)
    {
        
        $this->subheader = $subheader;
        return $this;
    }
    
    /**
     * Gets street
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }
  
    /**
     * Sets street
     * @param string $street Street name and number or postbox (can be null).
     * @return $this
     */
    public function setStreet($street)
    {
        
        $this->street = $street;
        return $this;
    }
    
    /**
     * Gets postal_code
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }
  
    /**
     * Sets postal_code
     * @param string $postal_code Postal code.
     * @return $this
     */
    public function setPostalCode($postal_code)
    {
        
        $this->postal_code = $postal_code;
        return $this;
    }
    
    /**
     * Gets city
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }
  
    /**
     * Sets city
     * @param string $city City.
     * @return $this
     */
    public function setCity($city)
    {
        
        $this->city = $city;
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
