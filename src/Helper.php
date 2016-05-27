<?php

namespace Securetrading\Unittest;

class Helper {
  public function recursiveRemoveDirectory($dir) {
    foreach(glob("$dir/{.svn*,*}", GLOB_BRACE) as $file) {
      if(is_dir($file)) { 
        $this->recursiveRemoveDirectory($file);
      } else {
	unlink($file);
      }
    }
    rmdir($dir);
  }

  public function copySourceDirToTestDir($sourceDir, $destDir) {
    if (!file_exists($destDir)) {
      mkdir($destDir, 0755, true);
    }

    foreach(
      $iterator = new \RecursiveIteratorIterator(
        new \RecursiveDirectoryIterator($sourceDir, \RecursiveDirectoryIterator::SKIP_DOTS),
        \RecursiveIteratorIterator::SELF_FIRST
      ) as $item
    ) {
      if ($item->isDir()) {
	mkdir($destDir . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
      } else {
	copy($item, $destDir . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
      }
    }
    return $destDir;
  }

  public function parseIniFile($filePath, $requiredKeys) {
    $parsedData = parse_ini_file($filePath, true);
    foreach($requiredKeys as $requiredKey) {
      if (!array_key_exists($requiredKey, $parsedData)) {
	throw new \Exception(sprintf('The key "%s" does not exist in %s.', $requiredKey, $filePath));
      }
    }
    return $parsedData;
  }

  public function getTestDir($folderName) {
    return sys_get_temp_dir() . DIRECTORY_SEPARATOR . $folderName . DIRECTORY_SEPARATOR;
  }
}