<?php

namespace Securetrading\Unittest\Tests\Unit;

use \Securetrading\Unittest\CoreMocker;

class CoreMockerTest extends \PHPUnit\Framework\TestCase {    
  public function test_MockingSimpleReturnValue() {
    $this->assertEquals(array(), CoreMocker::getMockedFunctions());

    CoreMocker::mockCoreFunction('date', 'todays date');

    $this->assertEquals(array('date' => 'todays date'), CoreMocker::getMockedFunctions());
    $this->assertEquals('todays date', CoreMocker::runCoreMock('date'));

    CoreMocker::releaseCoreMock('date');

    $this->assertEquals(array(), CoreMocker::getMockedFunctions());
    $this->assertEquals(1, preg_match('/^\d{4}-\d{2}-\d{2}$/', CoreMocker::runCoreMock('date', array('Y-m-d'))));
  }

  public function test_MockingWithCallback() {
    CoreMocker::mockCoreFunction('time', function($arg1 = null) {  // Note - core time() function accepts no params.
      if ($arg1) {
	return 'TIME'; 
      }
      return \time();
    });

    $this->assertTrue(array_key_exists('time', CoreMocker::getMockedFunctions()));
    $this->assertEquals('TIME', CoreMocker::runCoreMock('time', array(true)));
    $this->assertTrue(is_int(CoreMocker::runCoreMock('time', array(false))));
    
    CoreMocker::releaseCoreMocks();

    $this->assertEquals(array(), CoreMocker::getMockedFunctions());
  }
}