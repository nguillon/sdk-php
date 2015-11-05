<?php
/**
 * ReasonPayment
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
 * ReasonPayment Class Doc Comment
 *
 * @category    Class
 * @description 
 * @package     Organizeme\Xtractor
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class ReasonPayment implements ArrayAccess
{
    /**
      * Array of property to type mappings. Used for (de)serialization 
      * @var string[]
      */
    static $swaggerTypes = array(
        'raw' => 'string',
        'normalized' => 'string',
        'subtype' => 'string',
        'children' => '\Organizeme\Xtractor\Models\SemanticsElement[]',
        'rect' => '\Organizeme\Xtractor\Models\SemanticsCoordinates',
        'type' => 'string',
        'info' => '\Organizeme\Xtractor\Models\ReasonPaymentInfo'
    );
  
    /** 
      * Array of attributes where the key is the local name, and the value is the original name
      * @var string[] 
      */
    static $attributeMap = array(
        'raw' => 'raw',
        'normalized' => 'normalized',
        'subtype' => 'subtype',
        'children' => 'children',
        'rect' => 'rect',
        'type' => 'type',
        'info' => 'info'
    );
  
    /**
      * Array of attributes to setter functions (for deserialization of responses)
      * @var string[]
      */
    static $setters = array(
        'raw' => 'setRaw',
        'normalized' => 'setNormalized',
        'subtype' => 'setSubtype',
        'children' => 'setChildren',
        'rect' => 'setRect',
        'type' => 'setType',
        'info' => 'setInfo'
    );
  
    /**
      * Array of attributes to getter functions (for serialization of requests)
      * @var string[]
      */
    static $getters = array(
        'raw' => 'getRaw',
        'normalized' => 'getNormalized',
        'subtype' => 'getSubtype',
        'children' => 'getChildren',
        'rect' => 'getRect',
        'type' => 'getType',
        'info' => 'getInfo'
    );
  
    
    /**
      * $raw Original matched string.
      * @var string
      */
    protected $raw;
    
    /**
      * $normalized Normalized representation of this element.
      * @var string
      */
    protected $normalized;
    
    /**
      * $subtype Subtype of this element.
      * @var string
      */
    protected $subtype;
    
    /**
      * $children Child elements of this element.
      * @var \Organizeme\Xtractor\Models\SemanticsElement[]
      */
    protected $children;
    
    /**
      * $rect 
      * @var \Organizeme\Xtractor\Models\SemanticsCoordinates
      */
    protected $rect;
    
    /**
      * $type Type of this element.
      * @var string
      */
    protected $type;
    
    /**
      * $info 
      * @var \Organizeme\Xtractor\Models\ReasonPaymentInfo
      */
    protected $info;
    

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initalizing the model
     */
    public function __construct(array $data = null)
    {
        if ($data != null) {
            $this->raw = $data["raw"];
            $this->normalized = $data["normalized"];
            $this->subtype = $data["subtype"];
            $this->children = $data["children"];
            $this->rect = $data["rect"];
            $this->type = $data["type"];
            $this->info = $data["info"];
        }
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
     * @return \Organizeme\Xtractor\Models\SemanticsElement[]
     */
    public function getChildren()
    {
        return $this->children;
    }
  
    /**
     * Sets children
     * @param \Organizeme\Xtractor\Models\SemanticsElement[] $children Child elements of this element.
     * @return $this
     */
    public function setChildren($children)
    {
        
        $this->children = $children;
        return $this;
    }
    
    /**
     * Gets rect
     * @return \Organizeme\Xtractor\Models\SemanticsCoordinates
     */
    public function getRect()
    {
        return $this->rect;
    }
  
    /**
     * Sets rect
     * @param \Organizeme\Xtractor\Models\SemanticsCoordinates $rect 
     * @return $this
     */
    public function setRect($rect)
    {
        
        $this->rect = $rect;
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
     * @return \Organizeme\Xtractor\Models\ReasonPaymentInfo
     */
    public function getInfo()
    {
        return $this->info;
    }
  
    /**
     * Sets info
     * @param \Organizeme\Xtractor\Models\ReasonPaymentInfo $info 
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
