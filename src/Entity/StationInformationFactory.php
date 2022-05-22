<?php

namespace App\Entity;
use SimpleXMLIterator;

/**
 * The StationInformationFactory class create a StationInformation
 *
 * @see /App/Entity/StationInformation
 */
class StationInformationFactory
{
    /**
     * Create an StationInformation from xml node
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