<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Plane entity model
 *
 * @author namblue
 */
class Plane extends CI_Model
{
    public $id;
    public $manufacturer;
    public $model;
    public $price;
    public $seats;
    public $reach;
    public $cruise;
    public $takeoff;
    public $hourly;
    
    
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
    
    public function setId($value)
    {
        if (preg_match('/^[A-Z0-9_]+$/i', $value)) {
            $this->task = $value;
            return true;
        }
        return false;
    }
    
    public function setManufacturer($value)
    {
        if (preg_match('/^[A-Z]+$/i', $value) && strlen($value) <= 64) {
            $this->task = $value;
            return true;
        }
        return false;
    }
    
    public function setModel($value)
    {
        if (preg_match('/^[A-Z ]+$/i', $value) && strlen($value) <= 64) {
            $this->task = $value;
            return true;
        }
        return false;
    }
    
    public function setPrice($value)
    {
        if (is_int($value)) {
            $this->task = $value;
            return true;
        }
        return false;
    }
    
    public function setSeats($value)
    {
        if (is_int($value)) {
            $this->task = $value;
            return true;
        }
        return false;
    }
    
    public function setReach($value)
    {
        if (is_int($value)) {
            $this->task = $value;
            return true;
        }
        return false;
    }
    
    public function setCruise($value)
    {
        if (is_int($value)) {
            $this->task = $value;
            return true;
        }
        return false;
    }
    
    public function setTakeoff($value)
    {
        if (is_int($value)) {
            $this->task = $value;
            return true;
        }
        return false;
    }
    
    public function setHourly($value)
    {
        if (is_int($value)) {
            $this->task = $value;
            return true;
        }
        return false;
    }
}
