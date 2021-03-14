<?php

namespace Shelf;

use Drink\DrinkInterface;

abstract class AbstractShelf implements ShelfInterface
{
    /** @var DrinkInterface[] */
    protected $drinks = [];

    public function put(DrinkInterface $drink): DrinkInterface
    {
        if ($this->count() == $this->capacity()) {
            throw new \Exception('The shelf is full!');
        }

        $this->drinks[] = $drink;

        return $drink;
    }

    public function take(): DrinkInterface
    {
        if ($this->count() == 0) {
            throw new \Exception('The shelf is empty!');
        }

        return array_shift($this->drinks);
    }

    public function count(): int
    {
        return count($this->drinks);
    }
}