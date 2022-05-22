<?php

namespace App\Entity;

/**
 * Model store the calculi values
 */
class Model
{
    private float $morningTempAverage;
    private float $afternoonTempAverage;
    private float $eveningTempAverage;
    private float $nightTempAverage;

    private float $morningWeightAverage;
    private float $afternoonWeightAverage;
    private float $eveningWeightAverage;
    private float $nightWeightAverage;
    private float $dayMinTemp;
    private float $dayMaxTemp;
    private float $dayAvgTemp;

    /**
     * @param float $morningTempAverage
     * @param float $afternoonTempAverage
     * @param float $eveningTempAverage
     * @param float $nightTempAverage
     * @param float $morningWeightAverage
     * @param float $afternoonWeightAverage
     * @param float $eveningWeightAverage
     * @param float $nightWeightAverage
     * @param float $dayMinTemp
     * @param float $dayMaxTemp
     * @param float $dayAvgTemp
     */
    public function __construct(float $morningTempAverage, float $afternoonTempAverage,
                                float $eveningTempAverage, float $nightTempAverage,
                                float $morningWeightAverage, float $afternoonWeightAverage,
                                float $eveningWeightAverage, float $nightWeightAverage,
                                float $dayMinTemp, float $dayMaxTemp, float $dayAvgTemp)
    {
        $this->morningTempAverage = $morningTempAverage;
        $this->afternoonTempAverage = $afternoonTempAverage;
        $this->eveningTempAverage = $eveningTempAverage;
        $this->nightTempAverage = $nightTempAverage;
        $this->morningWeightAverage = $morningWeightAverage;
        $this->afternoonWeightAverage = $afternoonWeightAverage;
        $this->eveningWeightAverage = $eveningWeightAverage;
        $this->nightWeightAverage = $nightWeightAverage;
        $this->dayMinTemp = $dayMinTemp;
        $this->dayMaxTemp = $dayMaxTemp;
        $this->dayAvgTemp = $dayAvgTemp;
    }

    /**
     * @return float
     */
    public function getMorningTempAverage(): float
    {
        return $this->morningTempAverage;
    }

    /**
     * @param float $morningTempAverage
     */
    public function setMorningTempAverage(float $morningTempAverage): void
    {
        $this->morningTempAverage = $morningTempAverage;
    }

    /**
     * @return float
     */
    public function getAfternoonTempAverage(): float
    {
        return $this->afternoonTempAverage;
    }

    /**
     * @param float $afternoonTempAverage
     */
    public function setAfternoonTempAverage(float $afternoonTempAverage): void
    {
        $this->afternoonTempAverage = $afternoonTempAverage;
    }

    /**
     * @return float
     */
    public function getEveningTempAverage(): float
    {
        return $this->eveningTempAverage;
    }

    /**
     * @param float $eveningTempAverage
     */
    public function setEveningTempAverage(float $eveningTempAverage): void
    {
        $this->eveningTempAverage = $eveningTempAverage;
    }

    /**
     * @return float
     */
    public function getNightTempAverage(): float
    {
        return $this->nightTempAverage;
    }

    /**
     * @param float $nightTempAverage
     */
    public function setNightTempAverage(float $nightTempAverage): void
    {
        $this->nightTempAverage = $nightTempAverage;
    }

    /**
     * @return float
     */
    public function getMorningWeightAverage(): float
    {
        return $this->morningWeightAverage;
    }

    /**
     * @param float $morningWeightAverage
     */
    public function setMorningWeightAverage(float $morningWeightAverage): void
    {
        $this->morningWeightAverage = $morningWeightAverage;
    }

    /**
     * @return float
     */
    public function getAfternoonWeightAverage(): float
    {
        return $this->afternoonWeightAverage;
    }

    /**
     * @param float $afternoonWeightAverage
     */
    public function setAfternoonWeightAverage(float $afternoonWeightAverage): void
    {
        $this->afternoonWeightAverage = $afternoonWeightAverage;
    }

    /**
     * @return float
     */
    public function getEveningWeightAverage(): float
    {
        return $this->eveningWeightAverage;
    }

    /**
     * @param float $eveningWeightAverage
     */
    public function setEveningWeightAverage(float $eveningWeightAverage): void
    {
        $this->eveningWeightAverage = $eveningWeightAverage;
    }

    /**
     * @return float
     */
    public function getNightWeightAverage(): float
    {
        return $this->nightWeightAverage;
    }

    /**
     * @param float $nightWeightAverage
     */
    public function setNightWeightAverage(float $nightWeightAverage): void
    {
        $this->nightWeightAverage = $nightWeightAverage;
    }

    /**
     * @return float
     */
    public function getDayMinTemp(): float
    {
        return $this->dayMinTemp;
    }

    /**
     * @param float $dayMinTemp
     */
    public function setDayMinTemp(float $dayMinTemp): void
    {
        $this->dayMinTemp = $dayMinTemp;
    }

    /**
     * @return float
     */
    public function getDayMaxTemp(): float
    {
        return $this->dayMaxTemp;
    }

    /**
     * @param float $dayMaxTemp
     */
    public function setDayMaxTemp(float $dayMaxTemp): void
    {
        $this->dayMaxTemp = $dayMaxTemp;
    }

    /**
     * @return float
     */
    public function getDayAvgTemp(): float
    {
        return $this->dayAvgTemp;
    }

    /**
     * @param float $dayAvgTemp
     */
    public function setDayAvgTemp(float $dayAvgTemp): void
    {
        $this->dayAvgTemp = $dayAvgTemp;
    }


}