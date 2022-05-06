<?php

use Dotenv\Dotenv;
use Autoinspector\AutoinspectorClient;

include_once("vendor/autoload.php");

require_once("./lib/AutoinspectorClient.php");
require_once("./lib/Service/CoreServiceFactory.php");
require_once("./lib/Service/InspectionService.php");

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$testing = new AutoinspectorClient($_ENV['AUTOINSPECTOR_API_KEY']);

$testing->inspections->hello();
