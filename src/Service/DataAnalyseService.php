<?php

namespace App\Service;


use App\Entity\StationData;
use SplDoublyLinkedList;

/**
 * The DataAnalyseService class provides the main functionalities  to analyse loaded data
 */
class DataAnalyseService
{
    /**
     * @param SplDoublyLinkedList $climateData
     */
    public function getWeatherData(SplDoublyLinkedList $climateData)
    {
        //todo

        $data=[];
        for($i=1;$i<=31;$i++){
           $data[$i]=array('min' =>$i,'max'=>$i+1,'moy'=>$i+2);
        }
        $data["date"]=\date_create();
        return $data;
        for ($climateData->rewind(); $climateData->valid(); $climateData->next()) {
            /** @var StationData $current */
            $current = $climateData->current();
           // print_r($current->getDatetime()->format("W"));

        }

    }
}