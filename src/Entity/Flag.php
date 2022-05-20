<?php

namespace App\Entity;
/**
 * The Flag class
 */
class Flag
{
    private string $symbol;
    private string $description;

    /**
     * @param string $symbol
     * @param string $description
     */
    public function __construct(string $symbol, string $description)
    {
        $this->symbol = $symbol;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @param string $symbol
     */
    public function setSymbol(string $symbol): void
    {
        $this->symbol = $symbol;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }


}