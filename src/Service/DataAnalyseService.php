<?php

namespace App\Service;


use App\Entity\Model;
use App\Entity\StationData;
use SplDoublyLinkedList;

/**
 * The DataAnalyseService class provides the main functionalities  to analyse loaded data
 */
class DataAnalyseService
{
    private \DateTime $weatherDateTime;

    /**
     * getListModelAnalysed Fetch all Model Analyse
     * @param SplDoublyLinkedList $climateData
     */
    public function getListModelAnalysed(SplDoublyLinkedList $climateData)
    {
        $data = [];
        //part of days
        /** @var StationData $lastStationData */
        $lastStationData = $climateData->pop();
        //bind date
        $this->weatherDateTime = $lastStationData->getDatetime();
        //number of day of current month
        $nbDay = intval($lastStationData->getDatetime()->format("W"));
        //iterate on number of days of current Month : 31 for July //FIFO
        for ($numDay = 1; $numDay <= $nbDay; $numDay++) {
            //get model
            $data[$numDay] = $this->getAnalysedModel($climateData, $numDay, $lastStationData);

        }//endfor iterate days

        //store current

        return $data;
    }

    /**
     * getBestDaySummerEvent method give the best day to see a show
     * outdoor musical evening during the summer festival which took place from datetime
     * @param array $listModel
     * @param \DateTime $debut
     * @param \DateTime $fin
     * @return  \DateTime $bestDay
     * @note Si
     */
    public function getBestDaySummerEvent(array $listModel, \DateTime $debut, \DateTime $fin)
    {
        $date = date_create();
        $dayStart = intval($debut->format("d"));
        $dayEnd = intval($fin->format("d"));

        /** @var Model $goodDay */
        $goodDay = $listModel[1];
        $goodDayNumber = $dayStart;
        for ($i = $dayStart; $i <= $dayEnd; $i++) {
            if ($i <= sizeof($listModel)) {
                /** @var Model $model */
                $model = $listModel[$i];
                //get the max weight (Average) on afternoon
                if ($model->getAfternoonWeightAverage() > $goodDay->getAfternoonWeightAverage()) {
                    $goodDay = $model;
                    $goodDayNumber = $i;
                }
            }
        }
        return $date->setDate($this->weatherDateTime->format("Y"), $this->weatherDateTime->format("m"), $goodDayNumber);
    }

    /**
     * Get Average from  array
     * @param array $array
     * @return float|int
     */
    public function getAvgFromArray(array $array)
    {
        if (empty($array)) {
            throw new \InvalidArgumentException("Le tableau est vide .");
        }
        return array_sum($array) / sizeof($array);
    }


    /**
     * Get Model from climate Data
     * @param SplDoublyLinkedList $climateData
     * @return Model
     */
    public function getAnalysedModel(\SplDoublyLinkedList $climateData, int $numDay, StationData $last): Model
    {
        $sum = 0;
        $count = 0;
        $max = $last->getTemp();
        $min = $last->getTemp();
        for ($climateData->rewind(); $climateData->valid(); $climateData->next()) {
            /** @var StationData $currentDataStation */
            $currentDataStation = $climateData->current();
            //get current days number
            $currentNumberDays = intval($currentDataStation->getDatetime()->format("d"));
            //group data by days
            if ($numDay == $currentNumberDays) {
                $count++;
                //current temperature in C
                $currentTemp = $currentDataStation->getTemp();
                //get Max
                if ($currentTemp > $max) {
                    $max = $currentTemp;
                }
                //get Min
                if ($currentTemp < $min) {
                    $min = $currentTemp;
                }
                //set sum
                $sum += $currentTemp;
                //Parts of Days
                $currentHour = intval($currentDataStation->getDatetime()->format("H"));
                $weight = $currentDataStation->getWeightOfModel();
                $temp = $currentDataStation->getTemp();
                switch (true) {
                    case (($currentHour >= 5) && ($currentHour <= 12)) :
                    {
                        $morningWeight[] = $weight;
                        $morningTemp[] = $temp;
                        break;
                    }
                    case (($currentHour > 12) && ($currentHour <= 16)):
                    {
                        $afternoonWeight[] = $weight;
                        $afternoonTemp[] = $temp;
                        break;
                    }
                    case (($currentHour > 16) && ($currentHour <= 21)):
                    {
                        $eveningWeight[] = $weight;
                        $eveningTemp[] = $temp;
                        break;
                    }
                    default :
                    {
                        $nightWeight[] = $weight;
                        $nightTemp[] = $temp;
                        break;
                    }
                    //end Parts of Days
                }
            }
        }//endf
        //bind On Model
        $DayMinTemp = round($min, 1);
        $DayMaxTemp = round($max, 1);
        $DayAvgTemp = round($sum / $count, 1);
        //temp bind
        $morningTempAverage = $this->getAvgFromArray($morningTemp);
        $afternoonTempAverage = $this->getAvgFromArray($afternoonTemp);
        $eveningTempAverage = $this->getAvgFromArray($eveningTemp);
        $nightTempAverage = $this->getAvgFromArray($nightTemp);
        //weight bind
        $morningWeightAverage = $this->getAvgFromArray($morningWeight);
        $afternoonWeightAverage = $this->getAvgFromArray($afternoonWeight);
        $nightWeightAverage = $this->getAvgFromArray($nightWeight);
        $eveningWeightAverage = $this->getAvgFromArray($eveningWeight);

        return new Model($morningTempAverage, $afternoonTempAverage, $eveningTempAverage,
            $nightTempAverage, $morningWeightAverage, $afternoonWeightAverage,
            $eveningWeightAverage, $nightWeightAverage, $DayMinTemp,
            $DayMaxTemp, $DayAvgTemp);
    }

    /**
     * @return \DateTime
     */
    public function getWeatherDateTime(): \DateTime
    {
        return $this->weatherDateTime;
    }

    /**
     * @param \DateTime $weatherDateTime
     */
    public function setWeatherDateTime(\DateTime $weatherDateTime): void
    {
        $this->weatherDateTime = $weatherDateTime;
    }

    /**
     * getAvgTempByPeriod method give Average by moning evening afternoon and night
     * @param array $analyseData
     * @param int $nbDays
     * @return Model
     */
    public function getAvgTempByPeriod(array $analyseData, int $nbDays = 0): Model
    {
        $morningTempAverage = 0;
        $afternoonTempAverage = 0;
        $eveningTempAverage = 0;
        $nightTempAverage = 0;
        //get number of days of current month
        if ($nbDays == 0) {
            $nbDays = $this->getWeatherDateTime()->format("W");
        }

        for ($i = 1; $i <= sizeof($analyseData); $i++) {
            /** @var Model $model */
            $model = $analyseData[$i];
            $morningTempAverage += $model->getMorningTempAverage();
            $afternoonTempAverage += $model->getAfternoonTempAverage();
            $eveningTempAverage += $model->getEveningTempAverage();
            $nightTempAverage += $model->getNightTempAverage();
        }
        return new Model(round($morningTempAverage / $nbDays, 1),
            round($afternoonTempAverage / $nbDays, 1),
            round($eveningTempAverage / $nbDays, 1),
            round($nightTempAverage / $nbDays, 1),
            0, 0, 0, 0, 0, 0, 0);
    }


}