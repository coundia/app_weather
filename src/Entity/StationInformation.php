<?php

namespace App\Entity;
/**
 * The StationInformation class provides recursive iteration over all nodes of a <b>stationdata</b> object.
 *
 * @link https://php.net/manual/en/class.simplexmliterator.php
 */
class StationInformation
{
    private string $name;
    private string $province;
    private float $latitude;
    private float $longitude;
    private float $elevation;
    private int $climate_identifier;
    private string $wmo_identifier;
    private string $tc_identifier;
    private  string $note;

    /**
     * @param string $name
     * @param string $province
     * @param float $latitude
     * @param float $longitude
     * @param float $elevation
     * @param int $climate_identifier
     * @param string $wmo_identifier
     * @param string $tc_identifier
     * @param string $note
     */
    public function __construct(string $name, string $province, float $latitude, float $longitude, float $elevation, int $climate_identifier, string $wmo_identifier, string $tc_identifier, string $note)
    {
        $this->name = $name;
        $this->province = $province;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->elevation = $elevation;
        $this->climate_identifier = $climate_identifier;
        $this->wmo_identifier = $wmo_identifier;
        $this->tc_identifier = $tc_identifier;
        $this->note = $note;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getProvince(): string
    {
        return $this->province;
    }

    /**
     * @param string $province
     */
    public function setProvince(string $province): void
    {
        $this->province = $province;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return float
     */
    public function getElevation(): float
    {
        return $this->elevation;
    }

    /**
     * @param float $elevation
     */
    public function setElevation(float $elevation): void
    {
        $this->elevation = $elevation;
    }

    /**
     * @return int
     */
    public function getClimateIdentifier(): int
    {
        return $this->climate_identifier;
    }

    /**
     * @param int $climate_identifier
     */
    public function setClimateIdentifier(int $climate_identifier): void
    {
        $this->climate_identifier = $climate_identifier;
    }

    /**
     * @return string
     */
    public function getWmoIdentifier(): string
    {
        return $this->wmo_identifier;
    }

    /**
     * @param string $wmo_identifier
     */
    public function setWmoIdentifier(string $wmo_identifier): void
    {
        $this->wmo_identifier = $wmo_identifier;
    }

    /**
     * @return string
     */
    public function getTcIdentifier(): string
    {
        return $this->tc_identifier;
    }

    /**
     * @param string $tc_identifier
     */
    public function setTcIdentifier(string $tc_identifier): void
    {
        $this->tc_identifier = $tc_identifier;
    }

    /**
     * @return string
     */
    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * @param string $note
     */
    public function setNote(string $note): void
    {
        $this->note = $note;
    }


}