<?php

namespace App\Entity;

/**
 * class LegendFactory create an object Legend
 */
class LegendFactory
{

    /**
     * Load and save all legend in LikedList
     * @param \SimpleXMLIterator $legendNode
     */
    public function createLegend()
    {
        return new Legend(new \SplDoublyLinkedList());
    }
}