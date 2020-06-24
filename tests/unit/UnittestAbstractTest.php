<?php

namespace Securetrading\Unittest;

class UnittestAbstractTest extends \PHPUnit\Framework\TestCase {
  public function setUp() : void{
    $this->_unittestAbstract = $this->getMockForAbstractClass('\Securetrading\Unittest\UnittestAbstract');
  }
  
  /**
   *
   */
  public function test_addDataSet() {
    $this->_unittestAbstract->_($this->_unittestAbstract, '_addDataSet', 'value1', 'value2');
    $this->_unittestAbstract->_($this->_unittestAbstract, '_addDataSet', 'value3', 'value4');

    $expectedDataSets = array(
      array('value1', 'value2'),
      array('value3', 'value4'),
    );

    $actualDataSets = $this->_unittestAbstract->_($this->_unittestAbstract, '_getDataSets');
    $this->assertEquals($expectedDataSets, $actualDataSets);
  }

  /**
   *
   */
  public function test_addDataSet_ReturnValue() {
    $returnValue = $this->_unittestAbstract->_($this->_unittestAbstract, '_addDataSet', 'value1', 'value2');
    $this->assertSame($this->_unittestAbstract, $returnValue);
  }

  /**
   *
   */
  public function test_addDataSets() {
    $returnValue = $this->_unittestAbstract->_($this->_unittestAbstract, '_addDataSets', 
      array('value1', 'value2'),
      array('value3', 'value4')
    );

    $expectedDataSets = array(
      array('value1', 'value2'),
      array('value3', 'value4'),
    );

    $actualDataSets = $this->_unittestAbstract->_($this->_unittestAbstract, '_getDataSets');
    $this->assertEquals($expectedDataSets, $actualDataSets);
  }

  /**
   *
   */
  public function test_addDataSets_ReturnValue() {
    $returnValue = $this->_unittestAbstract->_($this->_unittestAbstract, '_addDataSets', 
      array('value1', 'value2'),
      array('value3', 'value4')
    );
    $this->assertSame($this->_unittestAbstract, $returnValue);
  }

  /**
   *
   */
  public function test_addNamedDataSet() {
    $this->_unittestAbstract->_($this->_unittestAbstract, '_addNamedDataSet', 'named1', 'value1');

    $expectedDataSets = array(
      'named1' => array('value1')
    );

    $actualDataSets = $this->_unittestAbstract->_($this->_unittestAbstract, '_getDataSets');
    $this->assertEquals($expectedDataSets, $actualDataSets);
  }

  /**
   *
   */
  public function test_addNamedDataSet_ReturnValue() {
    $returnValue = $this->_unittestAbstract->_($this->_unittestAbstract, '_addNamedDataSet', 'named1', 'value1');
    $this->assertSame($this->_unittestAbstract, $returnValue);
  }

  /**
   *
   */
  public function test_addNamedDataSets() {
    $this->_unittestAbstract->_($this->_unittestAbstract, '_addNamedDataSets', array('named1', 'value1'), array('named2', 'value2'));

    $expectedDataSets = array(
      'named1' => array('value1'),
      'named2' => array('value2'),
    );

    $actualDataSets = $this->_unittestAbstract->_($this->_unittestAbstract, '_getDataSets');
    $this->assertEquals($expectedDataSets, $actualDataSets);
  }

  /**
   *
   */
  public function test_addNamedDataSets_ReturnValue() {
    $returnValue = $this->_unittestAbstract->_($this->_unittestAbstract, '_addNamedDataSets', array('named1', array('value7')));
    $this->assertSame($this->_unittestAbstract, $returnValue);
  }

  /**
   * 
   */
  public function test_CombinedMethods() {
    $this->_unittestAbstract->_($this->_unittestAbstract, '_addDataSet', 'value1', 'value2');
    $this->_unittestAbstract->_($this->_unittestAbstract, '_addDataSets', array('value3', 'value4'));
    $this->_unittestAbstract->_($this->_unittestAbstract, '_addNamedDataSet', 'named1', 'value5');
    $this->_unittestAbstract->_($this->_unittestAbstract, '_addNamedDataSets', array('named2', 'value6'), array('named3', 'value7'));

    $expectedDataSets = array(
      array('value1', 'value2'),
      array('value3', 'value4'),
      'named1' => array('value5'),
      'named2' => array('value6'),
      'named3' => array('value7'),
    );

    $actualDataSets = $this->_unittestAbstract->_($this->_unittestAbstract, '_getDataSets');
    $this->assertEquals($expectedDataSets, $actualDataSets);
  }
}