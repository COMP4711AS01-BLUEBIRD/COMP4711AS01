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
        $idSet = $this->CI->tasks->setId(1);
        $destinationSet = $this->CI->tasks->setDestination('YAZ');
        $arrivalAirportSet = $this->CI->tasks->setArrivalAirport('Tofino/Long Beach Airport');
        $departureAirportSet = $this->CI->tasks->setDepartureAirport('Nanaimo Airport');
        $planeIdSet = $this->CI->tasks->setPlaneId('BB_avanti_001');
        $departureTimeSet = $this->CI->tasks->setDepartureTime('8:00');
        $arrivalTimeSet = $this->CI->tasks->setArrivalTime('8:50');
        
        $this->assertTrue($idSet);
        $this->assertTrue($destinationSet);
        $this->assertTrue($arrivalAirportSet);
        $this->assertTrue($departureAirportSet);
        $this->assertTrue($planeIdSet);
        $this->assertTrue($departureTimeSet);
        $this->assertTrue($arrivalTimeSet);
    }
    
    public function testFlightsFlightFailure()
    {
        $idSet = $this->CI->tasks->setId(1.0);
        $destinationSet = $this->CI->tasks->setDestination('YAZA');
        $arrivalAirportSet = $this->CI->tasks->setArrivalAirport(25);
        $departureAirportSet = $this->CI->tasks->setDepartureAirport(50);
        $planeIdSet = $this->CI->tasks->setPlaneId('BB avanti 001');
        $departureTimeSet = $this->CI->tasks->setDepartureTime('118:00');
        $arrivalTimeSet = $this->CI->tasks->setArrivalTime('8:50a');
        
        $this->assertFalse($idSet);
        $this->assertFalse($destinationSet);
        $this->assertFalse($arrivalAirportSet);
        $this->assertFalse($departureAirportSet);
        $this->assertFalse($planeIdSet);
        $this->assertFalse($departureTimeSet);
        $this->assertFalse($arrivalTimeSet);
    }
    
 }
