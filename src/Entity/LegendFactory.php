<?php

namespace App\Entity;

use SimpleXMLIterator;
use SplDoublyLinkedList;

/**
 * class LegendFactory create an object Legend
 */
class LegendFactory
{

    /**
     * Load and save all legend in LikedList
     *
     * @param SimpleXMLIterator $legendNode
     */
    public function createLegend()
    {
        return new Legend(new SplDoublyLinkedList());
    }
}