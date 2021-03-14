<?php

namespace Storage;

use Drink\DrinkInterface;

interface StorageInterface
{
    public function put(DrinkInterface $drink): DrinkInterface;

    public function take(): DrinkInterface;
}