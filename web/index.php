<?php

use App\Service\DataAnalyseService;
use App\Service\LoadDataService;
require dirname(__DIR__) . '/vendor/autoload.php';
//load  variables from .env
LoadDataService::loadDotEnv();
$pathReal=dirname(__DIR__).LoadDataService::getPath("PATH_FILE");
//instance of LoadDataService
$serviceLoad = new  LoadDataService();
//load data from XML
$climateData= $serviceLoad->getAllStationData($pathReal);
//dump
echo "Température";
dd($climateData->getListStationData());
//anlyse data
$dataAnalyseService = new  DataAnalyseService();
$temperatures = $dataAnalyseService->getTemperature($climateData->getListStationData()); //todo

//show data on twig
//todo