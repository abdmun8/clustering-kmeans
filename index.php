<?php
// display error
// ini_set('display_errors', 1);
error_reporting(0);

session_start();
// define constant
define("APP", "clustering-kmeans");
define("BASE_URL", "http://project.local/aabc/cluster-kmeans/");
// required file
require_once('api/index.php');
