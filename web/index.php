<?php
require dirname(__DIR__) . '/vendor/autoload.php';
// create a Dependend Inject container instance  (DI)
$container = new DI\Container();
//load DotEnv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
//load service
$service = new \App\Service\LoadDataService();
$output= $service->checkStatusService();
print_r($output);
