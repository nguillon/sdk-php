<?php
/**
 * Register
 *
 * PHP version 5
 *
 * @category Class
 * @package  Swagger\Client
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

namespace Swagger\Client\Model;

use \ArrayAccess;
/**
 * Register Class Doc Comment
 *
 * @category    Class
 * @description The normalized field holds the ID of the referenced company.
 * @package     Swagger\Client
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class Register implements ArrayAccess
{
    /**
      * Array of property to type mappings. Used for (de)serialization 
      * @var string[]
      */
    static $swaggerTypes = array(
        'rect' => '\Swagger\Client\Model\SemanticsCoordinates',
        'subtype' => 'string',
        'children' => '\Swagger\Client\Model\SemanticsElement[]',
        'normalized' => 'string',
        'raw' => 'string',
        'type' => 'string',
        'info' => '\Swagger\Client\Model\RegisterInfo'
    );
  
    /** 
      * Array of attributes where the key is the local name, and the value is the original name
      * @var string[] 
      */
    static $attributeMap = array(
        'rect' => 'rect',
        'subtype' => 'subtype',
        'children' => 'children',
        'normalized' => 'normalized',
        'raw' => 'raw',
        'type' => 'type',
        'info' => 'info'
    );
  
    /**
      * Array of attributes to setter functions (for deserialization of responses)
      * @var string[]
      */
    static $setters = array(
        'rect' => 'setRect',
        'subtype' => 'setSubtype',
        'children' => 'setChildren',
        'normalized' => 'setNormalized',
        'raw' => 'setRaw',
        'type' => 'setType',
        'info' => 'setInfo'
    );
  
    /**
      * Array of attributes to getter functions (for serialization of requests)
      * @var string[]
      */
    static $getters = array(
        'rect' => 'getRect',
        'subtype' => 'getSubtype',
        'children' => 'getChildren',
        'normalized' => 'getNormalized',
        'raw' => 'getRaw',
        'type' => 'getType',
        'info' => 'getInfo'
    );
  
    
    /**
      * $rect 
      * @var \Swagger\Client\Model\SemanticsCoordinates
      */
    protected $rect;
    
    /**
      * $subtype Subtype of this element.
      * @var string
      */
    protected $subtype;
    
    /**
      * $children Child elements of this element.
      * @var \Swagger\Client\Model\SemanticsElement[]
      */
    protected $children;
    
    /**
      * $normalized Normalized representation of this element.
      * @var string
      */
    protected $normalized;
    
    /**
      * $raw Original matched string.
      * @var string
      */
    protected $raw;
    
    /**
      * $type Type of this element.
      * @var string
      */
    protected $type;
    
    /**
      * $info 
      * @var \Swagger\Client\Model\RegisterInfo
      */
    protected $info;
    

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initalizing the model
     */
    public function __construct(array $data = null)
    {
        if ($data != null) {
            $this->rect = $data["rect"];
            $this->subtype = $data["subtype"];
            $this->children = $data["children"];
            $this->normalized = $data["normalized"];
            $this->raw = $data["raw"];
            $this->type = $data["type"];
            $this->info = $data["info"];
        }
    }
    
    /**
     * Gets rect
     * @return \Swagger\Client\Model\SemanticsCoordinates
     */
    public function getRect()
    {
        return $this->rect;
    }
  
    /**
     * Sets rect
     * @param \Swagger\Client\Model\SemanticsCoordinates $rect 
     * @return $this
     */
    public function setRect($rect)
    {
        
        $this->rect = $rect;
        return $this;
    }
    
    /**
     * Gets subtype
     * @return string
     */
    public function getSubtype()
    {
        return $this->subtype;
    }
  
    /**
     * Sets subtype
     * @param string $subtype Subtype of this element.
     * @return $this
     */
    public function setSubtype($subtype)
    {
        
        $this->subtype = $subtype;
        return $this;
    }
    
    /**
     * Gets children
     * @return \Swagger\Client\Model\SemanticsElement[]
     */
    public function getChildren()
    {
        return $this->children;
    }
  
    /**
     * Sets children
     * @param \Swagger\Client\Model\SemanticsElement[] $children Child elements of this element.
     * @return $this
     */
    public function setChildren($children)
    {
        
        $this->children = $children;
        return $this;
    }
    
    /**
     * Gets normalized
     * @return string
     */
    public function getNormalized()
    {
        return $this->normalized;
    }
  
    /**
     * Sets normalized
     * @param string $normalized Normalized representation of this element.
     * @return $this
     */
    public function setNormalized($normalized)
    {
        
        $this->normalized = $normalized;
        return $this;
    }
    
    /**
     * Gets raw
     * @return string
     */
    public function getRaw()
    {
        return $this->raw;
    }
  
    /**
     * Sets raw
     * @param string $raw Original matched string.
     * @return $this
     */
    public function setRaw($raw)
    {
        
        $this->raw = $raw;
        return $this;
    }
    
    /**
     * Gets type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
  
    /**
     * Sets type
     * @param string $type Type of this element.
     * @return $this
     */
    public function setType($type)
    {
        
        $this->type = $type;
        return $this;
    }
    
    /**
     * Gets info
     * @return \Swagger\Client\Model\RegisterInfo
     */
    public function getInfo()
    {
        return $this->info;
    }
  
    /**
     * Sets info
     * @param \Swagger\Client\Model\RegisterInfo $info 
     * @return $this
     */
    public function setInfo($info)
    {
        
        $this->info = $info;
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
