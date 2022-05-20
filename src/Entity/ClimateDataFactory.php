<?php

namespace App\Entity;
/****
 * The ClimateDataFactory create a ClimateData
 * @link https://php.net/manual/en/class.simplexmliterator.php
 */
class ClimateDataFactory
{
    /**
     * Create a ClimateData Object
     * @return ClimateData
     */
    public function createClimateData(StationInformation $StationInformation, Legend $legend, $lang):ClimateData
    {
        return new ClimateData($StationInformation,$legend,new \SplDoublyLinkedList(),$lang);
    }


}