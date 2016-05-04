<?php

namespace Securetrading\Unittest;

abstract class UnittestAbstract extends \PHPUnit_Framework_TestCase {
  protected $_dataSets = array();

  protected function _addDataSet() {
    $array = func_get_args();
    $this->_dataSets[] = $array;
    return $this;
  }

  protected function _addDataSets() {
    $dataSets = func_get_args();
    foreach($dataSets as $dataSet) {
      call_user_func_array(array($this, '_addDataSet'), $dataSet);
    }
    return $this;
  }
  
  protected function _addNamedDataSet() {
    $args = func_get_args();
    $key = array_shift($args);
    if (array_key_exists($key, $this->_dataSets)) {
      throw new \Exception('Test key exists.');
    }
    $this->_dataSets[$key] = $args;
    return $this;
  }

  protected function _addNamedDataSets() {
    $args = func_get_args();
    foreach($args as $dataSet) {
      call_user_func_array(array($this, '_addNamedDataSet'), $dataSet);
    }
    return $this;
  }

  protected function _getDataSets() {
    $cases = $this->_dataSets;
    $this->_dataSets = array();
    return $cases;
  }

  protected function _getPrivateProperty($instance, $propertyName) {
    $reflection = new \ReflectionClass($instance);
    $property = $reflection->getProperty($propertyName);
    $property->setAccessible(true);
    return $property->getValue($instance);
  }

  public function _($instance, $methodName) {
    if (!is_object($instance)) {
      throw new \Exception('Object must be provided.');
    }
    $className = get_class($instance);
    $class = new \ReflectionClass($className);
    $method = $class->getMethod($methodName);
    $method->setAccessible(true);
    $args = array_slice(func_get_args(), 2);
    return $method->invokeArgs($instance, $args);
  }
}