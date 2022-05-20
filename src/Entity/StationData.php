<?php

namespace App\Entity;
use Datetime;

/**
 * The StationData class save the weather information
 */
class StationData
{
    private float $temp;
    private float $dptemp;
    private float $relhum;
    private float $winddir;
    private float $windspd;
    private float $visibility;
    private float $stnpress;
    private Datetime $datetime;

    /***
     * @param float $temp Temperature in C
     * @param float $dptemp Dew Point Temperature in C
     * @param float $relhum Relative Humidity in %
     * @param float $winddir Wind Direction  in 10s deg
     * @param float $windspd Wind Speed   in km/h
     * @param float $visibility Visibility Km
     * @param float $stnpress Station Pressure  kPa
     * @param Datetime $datetime date
     */
    public function __construct(float $temp, float $dptemp, float $relhum, float $winddir, float $windspd, float $visibility, float $stnpress, Datetime $datetime)
    {
        $this->temp = $temp;
        $this->dptemp = $dptemp;
        $this->relhum = $relhum;
        $this->winddir = $winddir;
        $this->windspd = $windspd;
        $this->visibility = $visibility;
        $this->stnpress = $stnpress;
        $this->datetime = $datetime;
    }


    /**
     * @return float
     */
    public function getTemp(): float
    {
        return $this->temp;
    }

    /**
     * @param float $temp
     */
    public function setTemp(float $temp): void
    {
        $this->temp = $temp;
    }

    /**
     * @return float
     */
    public function getDptemp(): float
    {
        return $this->dptemp;
    }

    /**
     * @param float $dptemp
     */
    public function setDptemp(float $dptemp): void
    {
        $this->dptemp = $dptemp;
    }

    /**
     * @return float
     */
    public function getRelhum(): float
    {
        return $this->relhum;
    }

    /**
     * @param float $relhum
     */
    public function setRelhum(float $relhum): void
    {
        $this->relhum = $relhum;
    }

    /**
     * @return float
     */
    public function getWinddir(): float
    {
        return $this->winddir;
    }

    /**
     * @param float $winddir
     */
    public function setWinddir(float $winddir): void
    {
        $this->winddir = $winddir;
    }

    /**
     * @return float
     */
    public function getWindspd(): float
    {
        return $this->windspd;
    }

    /**
     * @param float $windspd
     */
    public function setWindspd(float $windspd): void
    {
        $this->windspd = $windspd;
    }

    /**
     * @return float
     */
    public function getVisibility(): float
    {
        return $this->visibility;
    }

    /**
     * @param float $visibility
     */
    public function setVisibility(float $visibility): void
    {
        $this->visibility = $visibility;
    }

    /**
     * @return float
     */
    public function getStnpress(): float
    {
        return $this->stnpress;
    }

    /**
     * @param float $stnpress
     */
    public function setStnpress(float $stnpress): void
    {
        $this->stnpress = $stnpress;
    }

    /**
     * @return Datetime
     */
    public function getDatetime(): Datetime
    {
        return $this->datetime;
    }

    /**
     * @param Datetime $datetime
     */
    public function setDatetime(Datetime $datetime): void
    {
        $this->datetime = $datetime;
    }


}