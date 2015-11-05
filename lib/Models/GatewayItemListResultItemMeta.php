<?php
/**
 * GatewayItemListResultItemMeta
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
 * GatewayItemListResultItemMeta Class Doc Comment
 *
 * @category    Class
 * @description Optional gateway specific metadata for the item.
 * @package     Organizeme\Xtractor
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class GatewayItemListResultItemMeta implements ArrayAccess
{
    /**
      * Array of property to type mappings. Used for (de)serialization 
      * @var string[]
      */
    static $swaggerTypes = array(
        'sender' => 'string',
        'amount' => 'string',
        'booking_status' => 'string',
        'month' => 'string',
        'received' => 'string',
        'operation_number' => 'string',
        'period_of_travel' => 'string',
        'invoice_number' => 'string',
        'hotel' => 'string',
        'invoice_date' => 'string',
        'currency' => 'string'
    );
  
    /** 
      * Array of attributes where the key is the local name, and the value is the original name
      * @var string[] 
      */
    static $attributeMap = array(
        'sender' => 'sender',
        'amount' => 'amount',
        'booking_status' => 'booking_status',
        'month' => 'month',
        'received' => 'received',
        'operation_number' => 'operation_number',
        'period_of_travel' => 'period_of_travel',
        'invoice_number' => 'invoice_number',
        'hotel' => 'hotel',
        'invoice_date' => 'invoice_date',
        'currency' => 'currency'
    );
  
    /**
      * Array of attributes to setter functions (for deserialization of responses)
      * @var string[]
      */
    static $setters = array(
        'sender' => 'setSender',
        'amount' => 'setAmount',
        'booking_status' => 'setBookingStatus',
        'month' => 'setMonth',
        'received' => 'setReceived',
        'operation_number' => 'setOperationNumber',
        'period_of_travel' => 'setPeriodOfTravel',
        'invoice_number' => 'setInvoiceNumber',
        'hotel' => 'setHotel',
        'invoice_date' => 'setInvoiceDate',
        'currency' => 'setCurrency'
    );
  
    /**
      * Array of attributes to getter functions (for serialization of requests)
      * @var string[]
      */
    static $getters = array(
        'sender' => 'getSender',
        'amount' => 'getAmount',
        'booking_status' => 'getBookingStatus',
        'month' => 'getMonth',
        'received' => 'getReceived',
        'operation_number' => 'getOperationNumber',
        'period_of_travel' => 'getPeriodOfTravel',
        'invoice_number' => 'getInvoiceNumber',
        'hotel' => 'getHotel',
        'invoice_date' => 'getInvoiceDate',
        'currency' => 'getCurrency'
    );
  
    
    /**
      * $sender Applies to the following gateway types: allianz.de
      * @var string
      */
    protected $sender;
    
    /**
      * $amount Applies to the following gateway types: congstar.de, o2online.de, telekom.de
      * @var string
      */
    protected $amount;
    
    /**
      * $booking_status Applies to the following gateway types: holidaycheck.de
      * @var string
      */
    protected $booking_status;
    
    /**
      * $month Applies to the following gateway types: congstar.de, telekom.de
      * @var string
      */
    protected $month;
    
    /**
      * $received Applies to the following gateway types: allianz.de
      * @var string
      */
    protected $received;
    
    /**
      * $operation_number Applies to the following gateway types: holidaycheck.de
      * @var string
      */
    protected $operation_number;
    
    /**
      * $period_of_travel Applies to the following gateway types: holidaycheck.de
      * @var string
      */
    protected $period_of_travel;
    
    /**
      * $invoice_number Applies to the following gateway types: congstar.de
      * @var string
      */
    protected $invoice_number;
    
    /**
      * $hotel Applies to the following gateway types: holidaycheck.de
      * @var string
      */
    protected $hotel;
    
    /**
      * $invoice_date Applies to the following gateway types: o2online.de
      * @var string
      */
    protected $invoice_date;
    
    /**
      * $currency Applies to the following gateway types: telekom.de
      * @var string
      */
    protected $currency;
    

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initalizing the model
     */
    public function __construct(array $data = null)
    {
        if ($data != null) {
            $this->sender = $data["sender"];
            $this->amount = $data["amount"];
            $this->booking_status = $data["booking_status"];
            $this->month = $data["month"];
            $this->received = $data["received"];
            $this->operation_number = $data["operation_number"];
            $this->period_of_travel = $data["period_of_travel"];
            $this->invoice_number = $data["invoice_number"];
            $this->hotel = $data["hotel"];
            $this->invoice_date = $data["invoice_date"];
            $this->currency = $data["currency"];
        }
    }
    
    /**
     * Gets sender
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }
  
    /**
     * Sets sender
     * @param string $sender Applies to the following gateway types: allianz.de
     * @return $this
     */
    public function setSender($sender)
    {
        
        $this->sender = $sender;
        return $this;
    }
    
    /**
     * Gets amount
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }
  
    /**
     * Sets amount
     * @param string $amount Applies to the following gateway types: congstar.de, o2online.de, telekom.de
     * @return $this
     */
    public function setAmount($amount)
    {
        
        $this->amount = $amount;
        return $this;
    }
    
    /**
     * Gets booking_status
     * @return string
     */
    public function getBookingStatus()
    {
        return $this->booking_status;
    }
  
    /**
     * Sets booking_status
     * @param string $booking_status Applies to the following gateway types: holidaycheck.de
     * @return $this
     */
    public function setBookingStatus($booking_status)
    {
        
        $this->booking_status = $booking_status;
        return $this;
    }
    
    /**
     * Gets month
     * @return string
     */
    public function getMonth()
    {
        return $this->month;
    }
  
    /**
     * Sets month
     * @param string $month Applies to the following gateway types: congstar.de, telekom.de
     * @return $this
     */
    public function setMonth($month)
    {
        
        $this->month = $month;
        return $this;
    }
    
    /**
     * Gets received
     * @return string
     */
    public function getReceived()
    {
        return $this->received;
    }
  
    /**
     * Sets received
     * @param string $received Applies to the following gateway types: allianz.de
     * @return $this
     */
    public function setReceived($received)
    {
        
        $this->received = $received;
        return $this;
    }
    
    /**
     * Gets operation_number
     * @return string
     */
    public function getOperationNumber()
    {
        return $this->operation_number;
    }
  
    /**
     * Sets operation_number
     * @param string $operation_number Applies to the following gateway types: holidaycheck.de
     * @return $this
     */
    public function setOperationNumber($operation_number)
    {
        
        $this->operation_number = $operation_number;
        return $this;
    }
    
    /**
     * Gets period_of_travel
     * @return string
     */
    public function getPeriodOfTravel()
    {
        return $this->period_of_travel;
    }
  
    /**
     * Sets period_of_travel
     * @param string $period_of_travel Applies to the following gateway types: holidaycheck.de
     * @return $this
     */
    public function setPeriodOfTravel($period_of_travel)
    {
        
        $this->period_of_travel = $period_of_travel;
        return $this;
    }
    
    /**
     * Gets invoice_number
     * @return string
     */
    public function getInvoiceNumber()
    {
        return $this->invoice_number;
    }
  
    /**
     * Sets invoice_number
     * @param string $invoice_number Applies to the following gateway types: congstar.de
     * @return $this
     */
    public function setInvoiceNumber($invoice_number)
    {
        
        $this->invoice_number = $invoice_number;
        return $this;
    }
    
    /**
     * Gets hotel
     * @return string
     */
    public function getHotel()
    {
        return $this->hotel;
    }
  
    /**
     * Sets hotel
     * @param string $hotel Applies to the following gateway types: holidaycheck.de
     * @return $this
     */
    public function setHotel($hotel)
    {
        
        $this->hotel = $hotel;
        return $this;
    }
    
    /**
     * Gets invoice_date
     * @return string
     */
    public function getInvoiceDate()
    {
        return $this->invoice_date;
    }
  
    /**
     * Sets invoice_date
     * @param string $invoice_date Applies to the following gateway types: o2online.de
     * @return $this
     */
    public function setInvoiceDate($invoice_date)
    {
        
        $this->invoice_date = $invoice_date;
        return $this;
    }
    
    /**
     * Gets currency
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }
  
    /**
     * Sets currency
     * @param string $currency Applies to the following gateway types: telekom.de
     * @return $this
     */
    public function setCurrency($currency)
    {
        
        $this->currency = $currency;
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
