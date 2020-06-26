<?php

namespace Securetrading\Unittest;

class IntegrationtestAbstract extends UnittestAbstract {
  protected $_testDir = '';

  public function __construct($name = null, array $data = array(), $dataName = '') {
    parent::__construct($name, $data, $dataName);
    $this->_helper = new Helper();
    $this->_testDir = $this->_helper->getTestDir('integration_tests');
    if (!file_exists($this->_testDir)) {
      mkdir($this->_testDir);
    }
  }

  public function setUp() : void {
    $this->_helper->recursiveRemoveDirectory($this->_testDir);
    mkdir($this->_testDir);
  }

  public function copySourceDirToTestDir($sourceDir, $subFolder = null) {
    $testDir = $this->_testDir;
    if ($subFolder) {
      $testDir .= $subFolder . DIRECTORY_SEPARATOR;
    }
    return $this->_helper->copySourceDirToTestDir($sourceDir, $testDir);
  }
}