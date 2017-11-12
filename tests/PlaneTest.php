<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlaneTest
 *
 * @author steve
 */
 class PlaneTest extends PHPUnit_Framework_TestCase
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
    
    public function testFleetPlane()
    {
        $idSet = $this->CI->tasks->setId('BB_avanti_001');
        $manufacturerSet = $this->CI->tasks->setManufacturer('Piaggo');
        $modelSet = $this->CI->tasks->setModel('Avanti II');
        $priceSet = $this->CI->tasks->setPrice(1000);
        $seatSet = $this->CI->tasks->setSeats(2797);
        $reachSet = $this->CI->tasks->setReach(2797);
        $cruiseSet = $this->CI->tasks->setCruise(589);
        $takeoffSet = $this->CI->tasks->setTakeoff(994);
        $hourlySet = $this->CI->tasks->setHourly(977);
        
        $this->assertTrue($idSet);
        $this->assertTrue($manufacturerSet);
        $this->assertTrue($modelSet);
        $this->assertTrue($priceSet);
        $this->assertTrue($seatSet);
        $this->assertTrue($reachSet);
        $this->assertTrue($cruiseSet);
        $this->assertTrue($takeoffSet);
        $this->assertTrue($hourlySet);
    }
    
    public function testFleetPlaneFailure()
    {
        $idSet = $this->CI->tasks->setId('BB avanti 001');
        $manufacturerSet = $this->CI->tasks->setManufacturer(7);
        $modelSet = $this->CI->tasks->setModel(20);
        $priceSet = $this->CI->tasks->setPrice('testing');
        $seatSet = $this->CI->tasks->setSeats(2589.056);
        $reachSet = $this->CI->tasks->setReach(43.879);
        $cruiseSet = $this->CI->tasks->setCruise('hello');
        $takeoffSet = $this->CI->tasks->setTakeoff('goodbye');
        $hourlySet = $this->CI->tasks->setHourly(897.0234);
        
        $this->assertFalse($idSet);
        $this->assertFalse($manufacturerSet);
        $this->assertFalse($modelSet);
        $this->assertFalse($priceSet);
        $this->assertFalse($seatSet);
        $this->assertFalse($reachSet);
        $this->assertFalse($cruiseSet);
        $this->assertFalse($takeoffSet);
        $this->assertFalse($hourlySet);
    }
    
 }