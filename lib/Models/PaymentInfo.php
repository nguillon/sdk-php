<?php
/**
 * PaymentInfo
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
 * PaymentInfo Class Doc Comment
 *
 * @category    Class
 * @description The children provide the coordinates for the \&quot;info\&quot; object&#39;s values.
 * @package     Organizeme\Xtractor
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class PaymentInfo implements ArrayAccess
{
    /**
      * Array of property to type mappings. Used for (de)serialization 
      * @var string[]
      */
    static $swaggerTypes = array(
        'account_number' => 'string',
        'bank_code' => 'string',
        'bank_name' => 'string',
        'iban' => 'string',
        'bic' => 'string'
    );
  
    /** 
      * Array of attributes where the key is the local name, and the value is the original name
      * @var string[] 
      */
    static $attributeMap = array(
        'account_number' => 'account_number',
        'bank_code' => 'bank_code',
        'bank_name' => 'bank_name',
        'iban' => 'iban',
        'bic' => 'bic'
    );
  
    /**
      * Array of attributes to setter functions (for deserialization of responses)
      * @var string[]
      */
    static $setters = array(
        'account_number' => 'setAccountNumber',
        'bank_code' => 'setBankCode',
        'bank_name' => 'setBankName',
        'iban' => 'setIban',
        'bic' => 'setBic'
    );
  
    /**
      * Array of attributes to getter functions (for serialization of requests)
      * @var string[]
      */
    static $getters = array(
        'account_number' => 'getAccountNumber',
        'bank_code' => 'getBankCode',
        'bank_name' => 'getBankName',
        'iban' => 'getIban',
        'bic' => 'getBic'
    );
  
    
    /**
      * $account_number Number of bank account.
      * @var string
      */
    protected $account_number;
    
    /**
      * $bank_code ID-Code of financial institution (BLZ/sort code/...).
      * @var string
      */
    protected $bank_code;
    
    /**
      * $bank_name Name of bank. (Not extracted, but taken from database based on bank_code or iban.)
      * @var string
      */
    protected $bank_name;
    
    /**
      * $iban IBAN
      * @var string
      */
    protected $iban;
    
    /**
      * $bic SWIFT BIC
      * @var string
      */
    protected $bic;
    

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initalizing the model
     */
    public function __construct(array $data = null)
    {
        if ($data != null) {
            $this->account_number = $data["account_number"];
            $this->bank_code = $data["bank_code"];
            $this->bank_name = $data["bank_name"];
            $this->iban = $data["iban"];
            $this->bic = $data["bic"];
        }
    }
    
    /**
     * Gets account_number
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->account_number;
    }
  
    /**
     * Sets account_number
     * @param string $account_number Number of bank account.
     * @return $this
     */
    public function setAccountNumber($account_number)
    {
        
        $this->account_number = $account_number;
        return $this;
    }
    
    /**
     * Gets bank_code
     * @return string
     */
    public function getBankCode()
    {
        return $this->bank_code;
    }
  
    /**
     * Sets bank_code
     * @param string $bank_code ID-Code of financial institution (BLZ/sort code/...).
     * @return $this
     */
    public function setBankCode($bank_code)
    {
        
        $this->bank_code = $bank_code;
        return $this;
    }
    
    /**
     * Gets bank_name
     * @return string
     */
    public function getBankName()
    {
        return $this->bank_name;
    }
  
    /**
     * Sets bank_name
     * @param string $bank_name Name of bank. (Not extracted, but taken from database based on bank_code or iban.)
     * @return $this
     */
    public function setBankName($bank_name)
    {
        
        $this->bank_name = $bank_name;
        return $this;
    }
    
    /**
     * Gets iban
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }
  
    /**
     * Sets iban
     * @param string $iban IBAN
     * @return $this
     */
    public function setIban($iban)
    {
        
        $this->iban = $iban;
        return $this;
    }
    
    /**
     * Gets bic
     * @return string
     */
    public function getBic()
    {
        return $this->bic;
    }
  
    /**
     * Sets bic
     * @param string $bic SWIFT BIC
     * @return $this
     */
    public function setBic($bic)
    {
        
        $this->bic = $bic;
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
