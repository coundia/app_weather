<?php

namespace App\Entity;
use SimpleXMLIterator;
use SplDoublyLinkedList;

/**
 * The Legend class provides the functionalities for saving the XML node (Flag) Array data as a doubly linked list.
 * @link https://php.net/manual/en/class.spldoublylinkedlist.php
 */
class Legend
{
    private SplDoublyLinkedList $flag;

    /**
     * @param SplDoublyLinkedList $flag
     */
    public function __construct(SplDoublyLinkedList $flag)
    {
        $this->flag = $flag;
    }

    /**
     * @return SplDoublyLinkedList
     */
    public function getFlag(): SplDoublyLinkedList
    {
        return $this->flag;
    }

    /**
     * @param SplDoublyLinkedList $flag
     */
    public function setFlag(SplDoublyLinkedList $flag): void
    {
        $this->flag = $flag;
    }

    /**
     * Fech flag node and saved it
     * @param SimpleXMLIterator $flagsNode
     */
    public function addAllFlagFromNode(SimpleXMLIterator $flagsNode)
    {
        for ($i = 0; $i < $flagsNode->flag->count(); $i++) {
            $nodes = $flagsNode->flag[$i];
            $current = new Flag(strval($nodes->symbol), strval($nodes->description));
            $this->flag->push($current);
        }
    }


}