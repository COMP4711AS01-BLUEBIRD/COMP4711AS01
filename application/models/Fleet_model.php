<?php

/**
 * This is a collection entity model for a fleet
 *
 * @author namblue
 */
class Fleet_Model extends CSV_Model
{
    public function __construct()
    {
        parent::__construct(APPPATH . '../data/fleet.csv', 'id');        
    }
    
    public function count()
    {
        $results = 0;
            foreach ($this->_data as $key => $record)
                $results++;
            return $results;
    }

    /*
     * Returns a list of plane ids from the csv file
     */
    public function planeIds()
    {
            $results = array();
            foreach ($this->_data as $key => $record)
                $results[] = $key;
            return $results;
    }
    
        // provide form validation rules
    public function rules()
    {
        $config = array(
        ['field' => 'price', 'label' => 'Price', 'rules' => 'required|numeric'],
        ['field' => 'seats', 'label' => 'Seats', 'rules' => 'required|numeric'],
        ['field' => 'reach', 'label' => 'Reach', 'rules' => 'required|numeric'],
        ['field' => 'cruise', 'label' => 'Cruise', 'rules' => 'required|numeric'],
        ['field' => 'takeoff', 'label' => 'Takeoff', 'rules' => 'required|numeric'],
        ['field' => 'hourly', 'label' => 'Hourly', 'rules' => 'required|numeric'],
        );
        return $config;
    }
    
    /*
     * Returns the total price of all planes in the fleet csv file
     */
    public function totalPrice()
    {
        $results = 0;
        foreach ($this->_data as $key => $record)
        {
            $results += (int)($record->Price);
        }
        return $results;
    }
}
