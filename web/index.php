<?php

use App\Service\LoadDataService;
use Twig\Loader\FilesystemLoader;
require dirname(__DIR__) . '/vendor/autoload.php';

//load .env
LoadDataService::loadDotEnv();
//set  templates path
$loader = new FilesystemLoader(dirname(__DIR__) . '/views');
//path XML file to load and  Analyse
$xmlPath = dirname(__DIR__) . LoadDataService::getVarsFromEnv("PATH_FILE");

//instance of LoadDataService
$serviceLoad = new  LoadDataService();
//load data from XML
$climateData = $serviceLoad->getAllStationData($xmlPath);
//anlyse data
//$dataAnalyseService = new  DataAnalyseService();
//$temperatures = $dataAnalyseService->getTemperature($climateData->getListStationData()); //todo
//dd($climateData->getListStationData());

$twig = new \Twig\Environment($loader, [
    'cache' => dirname(__DIR__) . '/cache',
    'debug' => true,
    'charset' => 'UTF-8',
    'strict_variables' => true,
    'autoescape' => 'html',
    'optimizations' => -1
]);
//create array for the views
$data =[];
$data["title"]= LoadDataService::getVarsFromEnv("TITLE");
$data["best_day_title"]= LoadDataService::getVarsFromEnv("BEST_DAY_TITLE");
$data["daily_avg_title"]= LoadDataService::getVarsFromEnv("DAILY_AVG_TITLE");
//render the views
echo $twig->render('weather.html.twig', $data);