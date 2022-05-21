<?php

namespace App\Entity;

class Temperature
{
    private \SplDoublyLinkedList $dailyTemp;
    private float $goodWeath;
    private float $morningAverage;
    private float $afternoonAverage;
    private float $eveningAverage;
    private float $nightAverage;

}