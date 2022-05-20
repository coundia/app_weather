<?php

namespace App\Entity;
use SimpleXMLIterator;

/**
 * The StationInformation class provides recursive iteration over all nodes of a <b>stationdata</b> object.
 * @link https://php.net/manual/en/class.simplexmliterator.php
 * @return StationData[]
 * @param string $path path
 */
class StationInformationFactory
{
    /**
     * Create an StationInformation
     * @param SimpleXMLIterator $stationinformation
     * @return StationInformation
     */
    public function createStationinformationFromXmlNode(SimpleXMLIterator $stationinformation): StationInformation
    {
        $name = strval($stationinformation->name);
        $province = strval($stationinformation->province);
        $latitude = strval($stationinformation->latitude);
        $longitude = strval($stationinformation->longitude);
        $elevation = strval($stationinformation->elevation);
        $climate_identifier = strval($stationinformation->climate_identifier);
        $wmo_identifier = strval($stationinformation->wmo_identifier);
        $tc_identifier = strval($stationinformation->tc_identifier);
        $note = strval($stationinformation->note);
        return new StationInformation($name, $province, $latitude, $longitude, $elevation, $climate_identifier, $wmo_identifier, $tc_identifier, $note);

    }


}