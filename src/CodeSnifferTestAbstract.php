<?php

namespace Securetrading\Unittest;

abstract class CodeSnifferTestAbstract extends \Securetrading\Unittest\IntegrationtestAbstract {
  abstract protected function _getDirToTest();

  public function testPsr2Compliance() {
    $codeSnifferPath = realpath(\Securetrading\Loader\Loader::getRootPath() . '..' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'phpcs');
    $dir = $this->_getDirToTest();

    $output = array();
    exec(escapeshellcmd($codeSnifferPath . " " . escapeshellarg($dir) . " --standard=PSR2 -v"), $output);

    $strContents = implode("\n", $output);
    $codeSnifferOutputFile = $this->_testDir . DIRECTORY_SEPARATOR . 'code_sniffer_output.txt';
    file_put_contents($codeSnifferOutputFile, $strContents);

    foreach($output as $k => $line) {
      if (preg_match('/^Processing .+ \((?P<errors>\d) errors, (?P<warnings>\d) warnings\)$/', $line, $matches) === 1) {
        $this->assertSame('0', $matches['errors'], sprintf("Errors in file.  CodeSniffer Output: %s.  See %s for the full log.", $line, $codeSnifferOutputFile));
        $this->assertSame('0', $matches['warnings'], sprintf("Warnings in file.  CodeSniffer Output: %s.  See %s for the full log.", $line, $codeSnifferOutputFile));
      }
    }
  }
}