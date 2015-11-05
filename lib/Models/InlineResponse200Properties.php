<?php
/**
 * InlineResponse200Properties
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
 * InlineResponse200Properties Class Doc Comment
 *
 * @category    Class
 * @description 
 * @package     Organizeme\Xtractor
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class InlineResponse200Properties implements ArrayAccess
{
    /**
      * Array of property to type mappings. Used for (de)serialization 
      * @var string[]
      */
    static $swaggerTypes = array(
        'custom_key_name1' => '\Organizeme\Xtractor\Models\ContentSimilarityResultPropertyRating[]'
    );
  
    /** 
      * Array of attributes where the key is the local name, and the value is the original name
      * @var string[] 
      */
    static $attributeMap = array(
        'custom_key_name1' => 'custom_key_name1'
    );
  
    /**
      * Array of attributes to setter functions (for deserialization of responses)
      * @var string[]
      */
    static $setters = array(
        'custom_key_name1' => 'setCustomKeyName1'
    );
  
    /**
      * Array of attributes to getter functions (for serialization of requests)
      * @var string[]
      */
    static $getters = array(
        'custom_key_name1' => 'getCustomKeyName1'
    );
  
    
    /**
      * $custom_key_name1 
      * @var \Organizeme\Xtractor\Models\ContentSimilarityResultPropertyRating[]
      */
    protected $custom_key_name1;
    

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initalizing the model
     */
    public function __construct(array $data = null)
    {
        if ($data != null) {
            $this->custom_key_name1 = $data["custom_key_name1"];
        }
    }
    
    /**
     * Gets custom_key_name1
     * @return \Organizeme\Xtractor\Models\ContentSimilarityResultPropertyRating[]
     */
    public function getCustomKeyName1()
    {
        return $this->custom_key_name1;
    }
  
    /**
     * Sets custom_key_name1
     * @param \Organizeme\Xtractor\Models\ContentSimilarityResultPropertyRating[] $custom_key_name1 
     * @return $this
     */
    public function setCustomKeyName1($custom_key_name1)
    {
        
        $this->custom_key_name1 = $custom_key_name1;
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
