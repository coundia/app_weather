<?php

namespace App\Entity;
use SplDoublyLinkedList;

/**
 * The ClimateDataFactory create a ClimateData
 *
 * @see ClimateData
 */
class ClimateDataFactory
{
    /**
     * Create a ClimateData Object
     *
     * @param StationInformation $StationInformation a StationInformation
     * @param Legend $legend a Legend
     * @param string $lang  a language
     * @return ClimateData a ClimateData
     */
    public function createClimateData(StationInformation $StationInformation, Legend $legend, $lang):ClimateData
    {
        return new ClimateData($StationInformation, $legend, new SplDoublyLinkedList(), $lang);
    }


}