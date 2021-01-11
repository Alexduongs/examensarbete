<?php

// Start session
// session_start();

require('dbconnect.php');

session_start();

// Turn on/off error reporting
// ini_set("error_reporting", E_ALL);
// error_reporting(E_ALL);
error_reporting(-1);
ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

// define('ROOT_PATH', '..' . __DIR__ . '/'); // path to 'my-page-3/'
// define('SRC_PATH',  __DIR__ . '/'); // path to 'my-page-3/src/'

try {	
    $query = "SELECT * FROM offices ";
    $stmt = $conn->query($query);
    $offices = $stmt->fetchall();
    }   catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }

    try {					
      $query = "SELECT * FROM office_specs ";
      $stmt = $conn->query($query);
      $office_specs = $stmt->fetchall();
      }   catch (\PDOException $e) {
      throw new \PDOException($e->getMessage(), (int) $e->getCode());
      }
?>
