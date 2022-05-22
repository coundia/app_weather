<?php

namespace Tests\Service;
use App\Service\LoadDataService;
use PHPUnit\Framework\TestCase;

final class LoadDataServiceTest extends TestCase
{

    /**
     * @var LoadDataService
     */
    private $loadDataService;

    protected function setUp(): void
    {
        LoadDataService::loadDotEnv();
        $this->loadDataService=new LoadDataService();
    }

    /***
     * Check if service is not null
     */
    public function testNullableService(): void
    {
        $this->assertNotNull($this->loadDataService, 'Le service ne peut pas etre NULL .');
    }
    /***
     * Check if data is empty null
     */
    public function testStatusService(): void
    {
        $status= $this->loadDataService->checkStatusService();
        $currentStatus=$_ENV["STATUS_UP"]??false;
        $this->assertEquals($status,$currentStatus,'Le STATUS_UP n\'est pas correctement configuré.');
    }
    /**
     * load  xml data
     */
    public function OftestLoadedDataFromFile(): void
    {
        $path = dirname(__DIR__) . "/../uploads/eng-hourly-07012015-07312015.xml";
        $result = $this->loadDataService->getAllStationData($path);
        $this->assertNotNull($result, 'La fonction getAllStationData() renvoie NULL  .');
        $this->assertNotEmpty($result->getListStationData()->count(), 'Les données metéo sont vides .');
    }


}
