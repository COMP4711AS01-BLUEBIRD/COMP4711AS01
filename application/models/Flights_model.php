<?php

/**
 * This is a collection entity model for flights
 *
 * @author namblue
 */
class Flights_Model extends CSV_Model
{
    public function __construct()
    {
        parent::__construct(APPPATH . '../data/flights.csv', 'id');
        $this->airports = $this->wacky->airports();
    }

    public function flightsDepartures(){

        $results = array();

        $flights = $this -> all();

        foreach ($flights as $flight){
            if(!in_array($flight->DepartureAirport, $results))
                $results[$flight->DepartureAirport]= $flight->DepartureAirport;
        }


        return $results;
    }

    public function flightsDeparturesWithNone(){

        $results = array();

        $flights = $this -> all();

        foreach ($flights as $flight){
            if(!in_array($flight->DepartureAirport, $results))
                $results[$flight->DepartureAirport]= $flight->DepartureAirport;
        }

        $results['None']= 'none';

        return $results;
    }

    public function flightsArrivals(){

        $results = array();

        $flights = $this -> all();

        foreach ($flights as $flight){
            if(!in_array($flight->ArrivalAirport, $results))
                $results[$flight->ArrivalAirport]= $flight->ArrivalAirport;
        }


        return $results;
    }
    
    // provide form validation rules
    public function rules()
    {
        $config = array(
        ['field' => 'ArrivalAirport', 'label' => 'Arrival Airport', 'rules' => 'differs[DepartureAirport]'],
        ['field' => 'DepartureTime', 'label' => 'Departure Time', 'rules' => 'required|differs[ArrivalTime]|callback_departureTime_Check'],
        ['field' => 'ArrivalTime', 'label' => 'Arrival Time', 'rules' => 'required|callback_arrivalTime_Check'],
        );
        return $config;
    }
    
    
}
