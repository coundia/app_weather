<?php

use App\Extension\TwigExtensionDate;
use App\Service\DataAnalyseService;
use App\Service\LoadDataService;
use Twig\Environment;
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
$twig = new Environment($loader, [
    'cache' => dirname(__DIR__) . '/cache',
//    'cache' => false,
    'debug' => true,
    'charset' => 'UTF-8',
    'strict_variables' => true,
    'autoescape' => 'html',
    'optimizations' => -1
]);
//add extensions lang
$twig->addExtension(new TwigExtensionDate());
//create array for the views
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
$data = [];
//get the label
$data["title"] = LoadDataService::getVarsFromEnv("TITLE");
$data["bestDayTitle"] = LoadDataService::getVarsFromEnv("BEST_DAY_TITLE");
$data["dailyAvgTitle"] = LoadDataService::getVarsFromEnv("DAILY_AVG_TITLE");
//get analysed data : Question 1
$data["analyseData"] = $dataAnalyseService->getListModelAnalysed($climateData->getListStationData());
//get current datetime to analyse
$data["weatherDateTime"] = $dataAnalyseService->getWeatherDateTime();
//get current month to analyse
$month=$dataAnalyseService->getWeatherDateTime()->format("m");
//get current years to analyse
$years=$dataAnalyseService->getWeatherDateTime()->format("Y");
//get current start days to analyse
$dayStart = LoadDataService::getVarsFromEnv("DAY_START");
//get end start days to analyse
$dayEnd = LoadDataService::getVarsFromEnv("DAY_END");
//set current start date to analyse
$dateStart  = date_create()->setDate($years, $month, $dayStart);
//set current end date to analyse
$dateEnd    = date_create()->setDate($years, $month, $dayEnd);
//get best day : Question 2
$data["bestDaySummer"] = $dataAnalyseService->getBestDaySummerEvent($data["analyseData"], $dateStart, $dateEnd);
//get average temp by period  : Question 3
$data["avgTempByPeriod"] = $dataAnalyseService->getAvgTempByPeriod($data["analyseData"]);
//dd($data);
//render the views
echo $twig->render('weather.html.twig', $data);