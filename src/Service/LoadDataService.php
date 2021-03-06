<?php

namespace App\Service;

use App\Entity\ClimateData;
use App\Entity\ClimateDataFactory;
use App\Entity\LegendFactory;
use App\Entity\StationDataFactory;
use App\Entity\StationInformationFactory;
use Dotenv\Dotenv;
use function dirname;

/**
 * The LoadDataService class provides the main functionalities for loading data from file
 *
 */
class LoadDataService
{
    private StationDataFactory $stationDataFactory;
    private ClimateDataFactory $climateDataFactory;
    private StationinformationFactory $stationinformationFactory;
    private LegendFactory $legendFactory;

    public function __construct()
    {
        $this->stationDataFactory = new StationDataFactory();
        $this->climateDataFactory = new ClimateDataFactory();
        $this->stationinformationFactory = new StationinformationFactory();
        $this->legendFactory = new LegendFactory();
    }


    /***
     *  get the value of STATUS_UP in .env
     * @return  string | bool
     */
    public function checkStatusService()
    {
        return $_ENV["STATUS_UP"] ?? false;
    }

    /**
     * Load value  in  .env file
     * @return void
     */
    public static function loadDotEnv():void
    {
          Dotenv::createMutable(dirname(__DIR__), "/../.env")->load();
    }

    /**
     *
     * This function provides recursive iteration over all nodes of a <b>stationdata</b> object.
     *
     *  Load Data  from XML and store it to Classes
     *
     * @link https://php.net/manual/en/class.simplexmliterator.php
     * @param string $path path of xml file
     */
    public function getAllStationData(string $path):ClimateData
    {
        $xml = new \SimpleXmlIterator($path, 0, true);
        $lang = strval($xml->lang);
        $stationinformation = $this->stationinformationFactory->createStationinformationFromXmlNode($xml->stationinformation);
        $legend = $this->legendFactory->createLegend();
        $legend->addAllFlagFromNode($xml->legend);
        $climateData = $this->climateDataFactory->createClimateData($stationinformation, $legend, $lang);
        $myStatinDataNode = $xml->stationdata;
        for ($myStatinDataNode->rewind(); $myStatinDataNode->valid(); $myStatinDataNode->next()) {
            if ($myStatinDataNode->haschildren()) {
                $nodes = $myStatinDataNode->getChildren();
                $currentStationData = $this->stationDataFactory->createStationDataFromXmlNode($nodes);
                $climateData->addStationData($currentStationData);
            }
        }
        return $climateData;
    }

    /***
     * Get veriable in .env
     *
     * @param string $varName
     * @return string
     */
    public static function getVarsFromEnv(string $varName): string
    {
        return $_ENV[$varName] ?? $varName;
    }
}