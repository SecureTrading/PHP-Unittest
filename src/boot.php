<?php

error_reporting(E_ALL | E_STRICT | E_DEPRECATED);

if (getenv('php_securetrading_unittest_run_type') !== 'plain') {
  print "\nTesting with Composer.\n";
  require_once($vendorDir . '/autoload.php');
}
else {
  print "\nTesting without Composer.\n";
  if (!isset($autoloaderPaths)) {
    throw new Exception('Autoloader paths not set.');
  }

  require_once($vendorDir . '/securetrading/core/src/Securetrading.php');
  \Securetrading\Securetrading::registerAutoloader();
  \Securetrading\Securetrading::setAutoloaderPaths($autoloaderPaths);
}