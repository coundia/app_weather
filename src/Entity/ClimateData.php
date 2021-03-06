<?php

namespace App\Entity;
use SplDoublyLinkedList;

/**
 * The ClimateData class provides the functionalities for saving the XML element (StationData) as a doubly linked list.
 *
 * @link https://php.net/manual/en/class.spldoublylinkedlist.php
 */
class ClimateData extends \SplDoublyLinkedList
{
    /**
     * @var string
     */
    private string $lang;
    /**
     * @var StationInformation
     */
    private StationInformation $stationInformation;
    /**
     * @var Legend
     */
    private $legend;
    /**
     * @var SplDoublyLinkedList
     */
    private SplDoublyLinkedList $listStationData;

    /**
     *  Constructor of StationInformation
     * @param StationInformation $stationInformation a StationInformation
     * @param Legend $legend a Legend
     * @param SplDoublyLinkedList $listStationData a SplDoublyLinkedList
     * @param string $lang a lang
     */
    public function __construct(StationInformation $stationInformation, Legend $legend, SplDoublyLinkedList $listStationData, string $lang = "ENG")
    {
        $this->lang = $lang;
        $this->stationInformation = $stationInformation;
        $this->legend = $legend;
        $this->listStationData = $listStationData;
    }

    /**
     * @return mixed
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param string $lang
     */
    public function setLang($lang): void
    {
        $this->lang = $lang;
    }

    /**
     * @return StationInformation
     */
    public function getStationInformation(): StationInformation
    {
        return $this->stationInformation;
    }

    /**
     * @param StationInformation $stationInformation
     */
    public function setStationInformation(StationInformation $stationInformation): void
    {
        $this->stationInformation = $stationInformation;
    }

    /**
     * @return mixed
     */
    public function getLegend()
    {
        return $this->legend;
    }

    /**
     * @param mixed $legend
     */
    public function setLegend($legend): void
    {
        $this->legend = $legend;
    }

    /**
     * @return SplDoublyLinkedList
     */
    public function getListStationData(): SplDoublyLinkedList
    {
        return $this->listStationData;
    }

    /**
     * @param SplDoublyLinkedList $listStationData
     */
    public function setListStationData(SplDoublyLinkedList $listStationData): void
    {
        $this->listStationData = $listStationData;
    }

    /**
     * Add a StationData in the list
     * @param StationData $currentStationData
     */
    public function addStationData(StationData $currentStationData)
    {
        $this->listStationData->push($currentStationData);
    }




}