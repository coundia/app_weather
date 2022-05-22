<?php

namespace App\Service;


use App\Entity\Model;
use App\Entity\StationData;
use SplDoublyLinkedList;

/**
 * The DataAnalyseService class provides the main functionalities  to analyse loaded data
 *
 */
class DataAnalyseService
{
    private \DateTime $weatherDateTime;

    /**
     * getListModelAnalysed Fetch all Model Analyse
     * iterate on number of days of current Month : 31 for July // FIFO
     * @param SplDoublyLinkedList $climateData
     */
    public function getListModelAnalysed(SplDoublyLinkedList $climateData)
    {
        $data = [];
        /** @var StationData $lastStationData */
        $lastStationData = $climateData->pop();
        $this->weatherDateTime = $lastStationData->getDatetime();
        $nbDay = intval($lastStationData->getDatetime()->format("W"));
        for ($numDay = 1; $numDay <= $nbDay; $numDay++) {
            $data[$numDay] = $this->getAnalysedModel($climateData, $numDay, $lastStationData);
        }
        return $data;
    }

    /**
     * getBestDaySummerEvent method give the best day to see a show
     * Outdoor musical evening during the summer festival which took place from datetime
     * get the max weight (Average) on afternoon
     *
     *
     * @param array $listModel
     * @param \DateTime $debut
     * @param \DateTime $fin
     * @return  \DateTime $bestDay
     *
     * @note
     * <pre>
     * Pour obtenir le milleur jour :
     * Je me suis basé sur la moyenne par Jour (le soir) d'un parametre score que j'ai calculé comme suit :
     * 1.J'ai attribu chaque parametre météorologique un poids posif ou negatif
     * 1.1 : Positif  si le parametre entrainne une bonne condition
     * 1.2 : Negatif  si le parametre entrainne une maivaise condition
     * 1.3 : Le jour qui le score le plus grand est le meilleur
     * ci-dessous la configuration qui se trouve dans le fichier .env
     * 2.Configuration des parametres
     * Ces parametres peuvent etre ajustes par un expert en meteorologie
     * WEIGHT_DB_TEMP = -1      # Température du point : entraine une maivaise condition
     * WEIGHT_REL_HUM = -1      # Humidité relative : entraine une maivaise condition
     * WEIGHT_WINDDIR = -1      # Direction du vent : entraine une maivaise condition
     * WEIGHT_WINSPD = -1       # Vitesse du vent : entraine une maivaise condition
     * WEIGHT_STNPRESS = -1     # Station Pressure : entraine une maivaise condition
     * WEIGHT_TEMP = 100        # Température entraine une bonne condition
     * WEIGHT_VISIBILITY = 100  # Visibility" units: entraine une bonne condition
     * </pre>
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
    * This function parses the ClimateData
     *
     * Calculate the (average) values according to the periods of the day,
     * and store it in the class Model
     *
     * @see /App/Entity/ClimateDate
     *
     * @param SplDoublyLinkedList $climateData
     * @param int $numDay
     * @param StationData $last
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
            $currentNumberDays = intval($currentDataStation->getDatetime()->format("d"));
            if ($numDay == $currentNumberDays) {
                $count++;
                $currentTemp = $currentDataStation->getTemp();
                if ($currentTemp > $max) {
                    $max = $currentTemp;
                }
                if ($currentTemp < $min) {
                    $min = $currentTemp;
                }
                $sum += $currentTemp;
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
                }
            }
        }// endf
        // bind On Model
        $DayMinTemp = round($min, 1);
        $DayMaxTemp = round($max, 1);
        $DayAvgTemp = round($sum / $count, 1);
        // temp bind
        $morningTempAverage = $this->getAvgFromArray($morningTemp);
        $afternoonTempAverage = $this->getAvgFromArray($afternoonTemp);
        $eveningTempAverage = $this->getAvgFromArray($eveningTemp);
        $nightTempAverage = $this->getAvgFromArray($nightTemp);
        // weight bind
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
     * Get  current weather DateTime
     *
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
     * This function calculates the average Temperature to the periods of the day
     *
     * Store it in the class Model
     *
     * @see /App/Entity/ClimateDate
     *
     *
     * @param array $analyseData analyse data
     * @param int $nbDays number of days
     * @return Model a Modal of data
     */
    public function getAvgTempByPeriod(array $analyseData, int $nbDays = 0): Model
    {
        $morningTempAverage = 0;
        $afternoonTempAverage = 0;
        $eveningTempAverage = 0;
        $nightTempAverage = 0;
        // get number of days of current month
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