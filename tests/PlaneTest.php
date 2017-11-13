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
        $idSet = $this->CI->plane->setId('BB001');
        $manufacturerSet = $this->CI->plane->setManufacturer('Piaggo');
        $modelSet = $this->CI->plane->setModel('Avanti II');
        $priceSet = $this->CI->plane->setPrice(1000);
        $seatSet = $this->CI->plane->setSeats(2797);
        $reachSet = $this->CI->plane->setReach(2797);
        $cruiseSet = $this->CI->plane->setCruise(589);
        $takeoffSet = $this->CI->plane->setTakeoff(994);
        $hourlySet = $this->CI->plane->setHourly(977);
        
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
        $idSet = $this->CI->plane->setId('BB avanti 001');
        $manufacturerSet = $this->CI->plane->setManufacturer(7);
        $modelSet = $this->CI->plane->setModel(20);
        $priceSet = $this->CI->plane->setPrice('testing');
        $seatSet = $this->CI->plane->setSeats(2589.056);
        $reachSet = $this->CI->plane->setReach(43.879);
        $cruiseSet = $this->CI->plane->setCruise('hello');
        $takeoffSet = $this->CI->plane->setTakeoff('goodbye');
        $hourlySet = $this->CI->plane->setHourly(897.0234);
        
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