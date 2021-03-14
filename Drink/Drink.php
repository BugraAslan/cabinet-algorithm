<?php

namespace Drink;

class Drink implements DrinkInterface
{
    /** @var string */
    private $drinkName;

    /**
     * Drink constructor.
     * @param string $drinkName
     */
    public function __construct(string $drinkName)
    {
        $this->drinkName = $drinkName;
    }
}