<?php

namespace Securetrading\Unittest;

class CoreMocker {
  protected static $_mockedFunctions = array();

  public static function getMockedFunctions() {
    return self::$_mockedFunctions;
  }

  public static function mockCoreFunction($functionName, $functionReturnValueOrCallback = null) {
    self::$_mockedFunctions[$functionName] = $functionReturnValueOrCallback;
  }

  public static function releaseCoreMock($functionName) {
    unset(self::$_mockedFunctions[$functionName]);
  }

  public static function releaseCoreMocks() {
    foreach(self::$_mockedFunctions as $functionName => $functionReturnValueOrCallback) {
      self::releaseCoreMock($functionName);
    }
  }

  public static function runCoreMock($functionName, array $args = array()) {
    if (isset(self::$_mockedFunctions[$functionName])) {
      $functionReturnValueOrCallback = self::$_mockedFunctions[$functionName];
      if (!is_string($functionReturnValueOrCallback) && is_callable($functionReturnValueOrCallback)) {
	$returnValue = call_user_func_array($functionReturnValueOrCallback, $args);
      }
      else {
	$returnValue = $functionReturnValueOrCallback;
      }
    }
    else {
      $returnValue = call_user_func_array($functionName, $args);
    }
    return $returnValue;
  }
}