<?php
/**
 * SemanticsResultMap
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
 * SemanticsResultMap Class Doc Comment
 *
 * @category    Class
 * @description 
 * @package     Swagger\Client
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class SemanticsResultMap implements ArrayAccess
{
    /**
      * Array of property to type mappings. Used for (de)serialization 
      * @var string[]
      */
    static $swaggerTypes = array(
        'addresses' => '\Swagger\Client\Model\Address[]',
        'amounts' => '\Swagger\Client\Model\Amount[]',
        'classifier' => '\Swagger\Client\Model\Classifier[]',
        'dates' => 'null[]',
        'phones' => '\Swagger\Client\Model\Phone[]',
        'registers' => '\Swagger\Client\Model\Register[]',
        'urls' => '\Swagger\Client\Model\Url[]',
        'payment' => 'null[]'
    );
  
    /** 
      * Array of attributes where the key is the local name, and the value is the original name
      * @var string[] 
      */
    static $attributeMap = array(
        'addresses' => 'addresses',
        'amounts' => 'amounts',
        'classifier' => 'classifier',
        'dates' => 'dates',
        'phones' => 'phones',
        'registers' => 'registers',
        'urls' => 'urls',
        'payment' => 'payment'
    );
  
    /**
      * Array of attributes to setter functions (for deserialization of responses)
      * @var string[]
      */
    static $setters = array(
        'addresses' => 'setAddresses',
        'amounts' => 'setAmounts',
        'classifier' => 'setClassifier',
        'dates' => 'setDates',
        'phones' => 'setPhones',
        'registers' => 'setRegisters',
        'urls' => 'setUrls',
        'payment' => 'setPayment'
    );
  
    /**
      * Array of attributes to getter functions (for serialization of requests)
      * @var string[]
      */
    static $getters = array(
        'addresses' => 'getAddresses',
        'amounts' => 'getAmounts',
        'classifier' => 'getClassifier',
        'dates' => 'getDates',
        'phones' => 'getPhones',
        'registers' => 'getRegisters',
        'urls' => 'getUrls',
        'payment' => 'getPayment'
    );
  
    
    /**
      * $addresses Extracted addresses.
      * @var \Swagger\Client\Model\Address[]
      */
    protected $addresses;
    
    /**
      * $amounts Extracted amounts.
      * @var \Swagger\Client\Model\Amount[]
      */
    protected $amounts;
    
    /**
      * $classifier Result of classifier. Always contains exactly one element (if present).
      * @var \Swagger\Client\Model\Classifier[]
      */
    protected $classifier;
    
    /**
      * $dates Extracted dates. Objects contained in this array have one of the following types: \"date\", \"date_interval\".
      * @var null[]
      */
    protected $dates;
    
    /**
      * $phones Extracted phone and fax numbers.
      * @var \Swagger\Client\Model\Phone[]
      */
    protected $phones;
    
    /**
      * $registers Extracted company registers and IDs.
      * @var \Swagger\Client\Model\Register[]
      */
    protected $registers;
    
    /**
      * $urls Extracted URLs and email addresses.
      * @var \Swagger\Client\Model\Url[]
      */
    protected $urls;
    
    /**
      * $payment Bank connections and information relevant to invoices. Objects contained in this array have one of the following types: \"payment\", \"reason_payment\", \"remittance_slip\".
      * @var null[]
      */
    protected $payment;
    

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initalizing the model
     */
    public function __construct(array $data = null)
    {
        if ($data != null) {
            $this->addresses = $data["addresses"];
            $this->amounts = $data["amounts"];
            $this->classifier = $data["classifier"];
            $this->dates = $data["dates"];
            $this->phones = $data["phones"];
            $this->registers = $data["registers"];
            $this->urls = $data["urls"];
            $this->payment = $data["payment"];
        }
    }
    
    /**
     * Gets addresses
     * @return \Swagger\Client\Model\Address[]
     */
    public function getAddresses()
    {
        return $this->addresses;
    }
  
    /**
     * Sets addresses
     * @param \Swagger\Client\Model\Address[] $addresses Extracted addresses.
     * @return $this
     */
    public function setAddresses($addresses)
    {
        
        $this->addresses = $addresses;
        return $this;
    }
    
    /**
     * Gets amounts
     * @return \Swagger\Client\Model\Amount[]
     */
    public function getAmounts()
    {
        return $this->amounts;
    }
  
    /**
     * Sets amounts
     * @param \Swagger\Client\Model\Amount[] $amounts Extracted amounts.
     * @return $this
     */
    public function setAmounts($amounts)
    {
        
        $this->amounts = $amounts;
        return $this;
    }
    
    /**
     * Gets classifier
     * @return \Swagger\Client\Model\Classifier[]
     */
    public function getClassifier()
    {
        return $this->classifier;
    }
  
    /**
     * Sets classifier
     * @param \Swagger\Client\Model\Classifier[] $classifier Result of classifier. Always contains exactly one element (if present).
     * @return $this
     */
    public function setClassifier($classifier)
    {
        
        $this->classifier = $classifier;
        return $this;
    }
    
    /**
     * Gets dates
     * @return null[]
     */
    public function getDates()
    {
        return $this->dates;
    }
  
    /**
     * Sets dates
     * @param null[] $dates Extracted dates. Objects contained in this array have one of the following types: \"date\", \"date_interval\".
     * @return $this
     */
    public function setDates($dates)
    {
        
        $this->dates = $dates;
        return $this;
    }
    
    /**
     * Gets phones
     * @return \Swagger\Client\Model\Phone[]
     */
    public function getPhones()
    {
        return $this->phones;
    }
  
    /**
     * Sets phones
     * @param \Swagger\Client\Model\Phone[] $phones Extracted phone and fax numbers.
     * @return $this
     */
    public function setPhones($phones)
    {
        
        $this->phones = $phones;
        return $this;
    }
    
    /**
     * Gets registers
     * @return \Swagger\Client\Model\Register[]
     */
    public function getRegisters()
    {
        return $this->registers;
    }
  
    /**
     * Sets registers
     * @param \Swagger\Client\Model\Register[] $registers Extracted company registers and IDs.
     * @return $this
     */
    public function setRegisters($registers)
    {
        
        $this->registers = $registers;
        return $this;
    }
    
    /**
     * Gets urls
     * @return \Swagger\Client\Model\Url[]
     */
    public function getUrls()
    {
        return $this->urls;
    }
  
    /**
     * Sets urls
     * @param \Swagger\Client\Model\Url[] $urls Extracted URLs and email addresses.
     * @return $this
     */
    public function setUrls($urls)
    {
        
        $this->urls = $urls;
        return $this;
    }
    
    /**
     * Gets payment
     * @return null[]
     */
    public function getPayment()
    {
        return $this->payment;
    }
  
    /**
     * Sets payment
     * @param null[] $payment Bank connections and information relevant to invoices. Objects contained in this array have one of the following types: \"payment\", \"reason_payment\", \"remittance_slip\".
     * @return $this
     */
    public function setPayment($payment)
    {
        
        $this->payment = $payment;
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
