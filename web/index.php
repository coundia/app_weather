<?php

use App\Extension\TwigExtensionDate;
use App\Service\DataAnalyseService;
use App\Service\LoadDataService;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

//use Twig\Extra\Intl\IntlExtension;

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
$twig = new Environment($loader, [
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
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

$data = [];
$data["title"] = LoadDataService::getVarsFromEnv("TITLE");
$data["bestDayTitle"] = LoadDataService::getVarsFromEnv("BEST_DAY_TITLE");
$data["dailyAvgTitle"] = LoadDataService::getVarsFromEnv("DAILY_AVG_TITLE");
//get analyse data
$data["analyseData"] = $dataAnalyseService->getListModelAnalysed($climateData->getListStationData());
$data["weatherDateTime"] = $dataAnalyseService->getWeatherDateTime();
$debut = date_create()->setDate(2015, 07, 9);
$fin = date_create()->setDate(2015, 07, 19);

$data["bestDaySummer"] = $dataAnalyseService->getBestDaySummerEvent($data["analyseData"], $debut, $fin);
$data["avgTempByPeriod"] = $dataAnalyseService->getAvgTempByPeriod($data["analyseData"]);
//render the views
echo $twig->render('weather.html.twig', $data);