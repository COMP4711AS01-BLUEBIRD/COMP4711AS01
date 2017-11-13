<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FlightTest
 *
 * @author steve
 */
class FlightTest extends PHPUnit_Framework_TestCase
 {
    private $CI;
    public function setUp()
    {
      // Load CI instance normally
      $this->CI = &get_instance();
    }
    public function testGetPost()
    {
      $_SERVER['REQUEST_METHOD'] = 'GET';
      $_GET['foo'] = 'bar';
      $this->assertEquals('bar', $this->CI->input->get_post('foo'));
    }
    
    public function testFlightsFlight()
    {
        $destinationSet = $this->CI->flight->setDestination('YAZ');
        $arrivalAirportSet = $this->CI->flight->setArrivalAirport('Long Beach Airport');
        $departureAirportSet = $this->CI->flight->setDepartureAirport('Nanaimo Airport');
        $planeIdSet = $this->CI->flight->setPlaneId('BB_avanti_001');
        $departureTimeSet = $this->CI->flight->setDepartureTime('8:00');
        $arrivalTimeSet = $this->CI->flight->setArrivalTime('8:50');
        
        $this->assertTrue($destinationSet);
        $this->assertTrue($arrivalAirportSet);
        $this->assertTrue($departureAirportSet);
        $this->assertTrue($planeIdSet);
        $this->assertTrue($departureTimeSet);
        $this->assertTrue($arrivalTimeSet);
    }
    
    public function testFlightsFlightFailure()
    {
        $destinationSet = $this->CI->flight->setDestination('YAZA');
        $arrivalAirportSet = $this->CI->flight->setArrivalAirport(25);
        $departureAirportSet = $this->CI->flight->setDepartureAirport(50);
        $planeIdSet = $this->CI->flight->setPlaneId('BB avanti 001');
        $departureTimeSet = $this->CI->flight->setDepartureTime('118:00');
        $arrivalTimeSet = $this->CI->flight->setArrivalTime('8:50a');
        
        $this->assertFalse($destinationSet);
        $this->assertFalse($arrivalAirportSet);
        $this->assertFalse($departureAirportSet);
        $this->assertFalse($planeIdSet);
        $this->assertFalse($departureTimeSet);
        $this->assertFalse($arrivalTimeSet);
    }
    
 }
