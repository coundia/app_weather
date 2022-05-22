<?php

namespace Tests\Service;

use App\Entity\ClimateData;
use App\Entity\ClimateDataFactory;
use App\Entity\StationData;
use App\Service\DataAnalyseService;
use App\Service\LoadDataService;
use PHPUnit\Framework\TestCase;

class DataAnalyseServiceTest extends TestCase
{

    protected LoadDataService $loadDataService;

    protected DataAnalyseService  $dataAnalyseService;

    protected function setUp(): void
    {
        LoadDataService::loadDotEnv();
        $this->loadDataService=new LoadDataService();
        $this->dataAnalyseService=new DataAnalyseService();
    }
    /**
     * test average  IS OK
     */
    public function testAvgFromArray(){
        $array =[10,11,9];
        $avg=$this->dataAnalyseService->getAvgFromArray($array);
        $this->assertEquals(10,$avg);
    }
    /**
     * test average is FAIL
     */
    public function testAvgFromArrayFail(){
        $array =[10,11,7];
        $avg=$this->dataAnalyseService->getAvgFromArray($array);
        $this->assertNotEquals(10,$avg);
    }
    /**
     * test min temps
     */
    public function testMin(){
        $s1=new StationData(17,1,1,1,1,1,1,date_create());
        $s2=new StationData(20,1,1,1,1,1,1,date_create());
        $climateData= new \SplDoublyLinkedList();
        $climateData->push($s1);
        $climateData->push($s2);
        $this->dataAnalyseService->getWeatherData($climateData);
       // dd($climateData);
    }

}