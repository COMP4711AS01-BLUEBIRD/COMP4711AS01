<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Flight entity model
 *
 * @author namblue
 */
class Flight extends CI_Model
{
    public $id;
    public $destination;
    public $arrivalAirport;
    public $departureAirport;
    public $planeId;
    public $departureTime;
    public $arrivalTime;
    
    public function __construct()
    {
            parent::__construct();
    }
    
    // If this class has a setProp method, use it, else modify the property directly
    public function __set($key, $value) {
        // if a set* method exists for this key, 
        // use that method to insert this value. 
        // For instance, setName(...) will be invoked by $object->name = ...
        // and setLastName(...) for $object->last_name = 
        $method = 'set' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $key)));
        if (method_exists($this, $method))
        {
                $this->$method($value);
                return $this;
        }

        // Otherwise, just set the property value directly.
        $this->$key = $value;
        return $this;
    }
        
    public function setDestination($value)
    {
        if (preg_match('/^[A-Z]+$/i', $value) && strlen($value) == 3) {
            $this->task = $value;
            return true;
        }
        return false;
    }
   
    public function setArrivalAirport($value)
    {
        if (preg_match('/^[A-Z\/ \(\)]+$/i', $value)) {
            $this->task = $value;
            return true;
        }
        return false;
    }
    
    public function setDepartureAirport($value)
    {
        if (preg_match('/^[A-Z\/ \(\)]+$/i', $value)) {
            $this->task = $value;
            return true;
        }
        return false;
    }
    
    public function setPlaneId($value)
    {
        if (preg_match('/^[a-zA-Z0-9_]+$/i', $value)) {
            $this->task = $value;
            return true;
        }
        return false;
    }
    
    public function setArrivalTime($value)
    {
        if (preg_match('/^([0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/i', $value)) {
            $this->task = $value;
            return true;
        }
        return false;
    }
    
    public function setDepartureTime($value)
    {
        if (preg_match('/^([0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/i', $value)) {
            $this->task = $value;
            return true;
        }
        return false;
    }
}
