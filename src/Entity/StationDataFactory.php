<?php

namespace App\Entity;
use SimpleXMLIterator;
use function date_create;

/****
 * The StationDataFactory create  a StationData from a recursive iteration
 * over all nodes of a <b>SimpleXMLIterator</b> object.
 * @param SimpleXMLIterator $data
 * @link https://php.net/manual/en/class.simplexmliterator.php
 */
class StationDataFactory
{
    /**
     * @param SimpleXMLIterator $stationDataNode station data xml node
     * @return StationData a station data
     */
    public function createStationDataFromXmlNode(SimpleXMLIterator $stationDataNode): StationData
    {
        $datetime = date_create();
        $attribute = $stationDataNode->attributes();
        $datetime->setDate(intval($attribute->year), intval($attribute->month), intval($attribute->day));
        $datetime->setTime(intval($attribute->hour), intval($attribute->minute, 0));
        $temp = is_float($stationDataNode->temp) ? $stationDataNode->temp : floatval($stationDataNode->temp);
        $dptemp = is_float($stationDataNode->dptemp) ? $stationDataNode->dptemp : floatval($stationDataNode->dptemp);
        $relhum = is_float($stationDataNode->relhum) ? $stationDataNode->relhum : floatval($stationDataNode->relhum);
        $winddir = is_float($stationDataNode->winddir) ? $stationDataNode->winddir : floatval($stationDataNode->winddir);
        $windspd = is_float($stationDataNode->windspd) ? $stationDataNode->windspd : floatval($stationDataNode->windspd);
        $visibility = is_float( $stationDataNode->visibility)? $stationDataNode->visibility:floatval($stationDataNode->visibility);
        $stnpress = is_float( $stationDataNode->stnpress)? $stationDataNode->stnpress:floatval($stationDataNode->stnpress);
        return new StationData( $temp,  $dptemp,  $relhum,  $winddir,  $windspd,  $visibility,  $stnpress, $datetime);
    }

}