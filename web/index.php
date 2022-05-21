<?php

use App\Extension\TwigExtensionDate;
use App\Service\DataAnalyseService;
use App\Service\LoadDataService;
//use Twig\Extra\Intl\IntlExtension;
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
//instance of anlyse data
$dataAnalyseService = new  DataAnalyseService();
//load data from XML
$climateData = $serviceLoad->getAllStationData($xmlPath);

//twig settings
$twig = new \Twig\Environment($loader, [
//    'cache' => dirname(__DIR__) . '/cache',
    'cache' => false,
    'debug' => true,
    'charset' => 'UTF-8',
    'strict_variables' => true,
    'autoescape' => 'html',
    'optimizations' => -1
]);
//add extensions lang
//$twig->addExtension(new IntlExtension());
$twig->addExtension(new TwigExtensionDate());
//create array for the views
setlocale (LC_TIME, 'fr_FR.utf8','fra');

$data = [];
$data["title"] = LoadDataService::getVarsFromEnv("TITLE");
$data["bestDayTitle"] = LoadDataService::getVarsFromEnv("BEST_DAY_TITLE");
$data["dailyAvgTitle"] = LoadDataService::getVarsFromEnv("DAILY_AVG_TITLE");
$data["temperatures"] = $dataAnalyseService->getWeatherData($climateData->getListStationData());
#end bind data
//dd($data);
//render the views
echo $twig->render('weather.html.twig', $data);