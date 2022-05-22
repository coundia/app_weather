<?php

namespace Tests\Service;

use App\Entity\Model;
use App\Entity\StationData;
use App\Service\DataAnalyseService;
use App\Service\LoadDataService;
use PHPUnit\Framework\TestCase;

/**
 * DataAnalyseServiceTest class for tested  the analyse data
 */
class DataAnalyseServiceTest extends TestCase
{

    protected LoadDataService $loadDataService;

    protected DataAnalyseService $dataAnalyseService;
    protected array $modelData;

    protected function setUp(): void
    {
        LoadDataService::loadDotEnv();
        $this->loadDataService = new LoadDataService();
        $this->dataAnalyseService = new DataAnalyseService();
        //setup Model data
        // it s a not good Day =>  afternoon score => 1
        $this->modelData["1"] = new Model(1, 1, 1, 1,
            1, 1, 1,
            1, 1, 1, 1);
        // it s a good Day =>  afternoon score => 10
        $this->modelData["2"] = new Model(1, 1, 1, 1,
            1, 10, 1,
            1, 1, 1, 1);
        // it s a good Day =>  afternoon score => 5
        $this->modelData["3"] = new Model(1, 1, 1, 1,
            1, 5, 1,
            1, 1, 1, 1);
    }

    /**
     * test average  IS OK
     */
    public function testAvgFromArray()
    {
        $array = [10, 11, 9];
        $avg = $this->dataAnalyseService->getAvgFromArray($array);
        $this->assertEquals(10, $avg);
    }

    /**
     * test average is FAIL
     */
    public function testAvgFromArrayFail()
    {
        $array = [10, 11, 7];
        $avg = $this->dataAnalyseService->getAvgFromArray($array);
        $this->assertNotEquals(10, $avg);
    }

    /**
     * test testGetWeightOfModel to test the max weight
     */
    public function testGetWeightOfModel()
    {
        //$dataMin has less visibily and less temp
        $dataMin = new StationData(19, 20, 11, 1, 1, 1, 1, date_create());
        //$dataMin has more visibily and more temp : it s a good Day
        $dataMax = new StationData(21, 20, 1, 1, 1, 2, 1, date_create());
        $wgMin = $dataMin->getWeightOfModel();
        $wgMax = $dataMax->getWeightOfModel();
        print_r(" #Poids Min = " . $wgMin);
        print_r(" ;#Poids Max  = " . $wgMax);
        $this->assertLessThan($wgMax, $wgMin);
    }

    /**
     * Question 2 : test testGetBestDaySummerEvent to test the best day (hight score of  weight
     */
    public function testGetBestDaySummerEvent()
    {
        $dateStart = date_create()->setDate(2022, 7, 1);
        $dateEnd = date_create()->setDate(2022, 7, 4);
        $this->dataAnalyseService->setWeatherDateTime($dateStart);
        $bestDaySummerAfternoon = $this->dataAnalyseService->getBestDaySummerEvent($this->modelData, $dateStart, $dateEnd);
        print_r(" #bestDaySummerAfternoon = " . $bestDaySummerAfternoon->format("d"));
        //the good day is 02 with afternoon score 10
        $this->assertEquals("02", $bestDaySummerAfternoon->format("d"));
    }

    /**
     * Question 3 : test testGetAvgTempByPeriod to test get average temp by period
     */
    public function testGetAvgTempByPeriod()
    {
        //get average temp by period
        $this->dataAnalyseService->setWeatherDateTime(date_create());
        $responseModel = $this->dataAnalyseService->getAvgTempByPeriod($this->modelData,sizeof($this->modelData));
        $this->assertEquals(1, $responseModel->getMorningTempAverage());
        $this->assertEquals(1, $responseModel->getAfternoonTempAverage());
        $this->assertEquals(1, $responseModel->getEveningTempAverage());
        $this->assertEquals(1, $responseModel->getNightTempAverage());
    }

}