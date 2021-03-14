<?php

namespace Test;

use Storage\Cabinet;
use Drink\Drink;
use Shelf\CabinetShelf;

include 'Drink/DrinkInterface.php';
include 'Drink/Drink.php';
include 'Storage/StorageInterface.php';
include 'Storage/Cabinet.php';
include 'Shelf/ShelfInterface.php';
include 'Shelf/AbstractShelf.php';
include 'Shelf/CabinetShelf.php';
include 'Util/DoorStatus.php';
include 'Util/CabinetStatus.php';

class CabinetTest
{
    public function testFullCabinet(): string
    {
        $cabinet = new Cabinet();
        $cabinet->openDoor();
        $cabinet = $this->addShelves($cabinet);

        $drink = new Drink('Sprite');
        for ($i = 0; $i < 60; $i++) {
            $cabinet->put($drink);
        }

        $cabinet->closeDoor();

        return $cabinet->getStatus();
    }

    public function addShelves(Cabinet $cabinet): Cabinet
    {
        $cabinet->addShelf(new CabinetShelf());
        $cabinet->addShelf(new CabinetShelf());
        $cabinet->addShelf(new CabinetShelf());

        return $cabinet;
    }

    public function testPartialFullCabinet(): string
    {
        $cabinet = new Cabinet();
        $cabinet->openDoor();
        $cabinet = $this->addShelves($cabinet);

        $drink = new Drink('Sprite');
        $cabinet->put($drink);
        $cabinet->closeDoor();

        return $cabinet->getStatus();
    }

    public function testEmptyCabinet(): string
    {
        $cabinet = new Cabinet();
        $cabinet->openDoor();
        $cabinet = $this->addShelves($cabinet);
        $cabinet->closeDoor();

        return $cabinet->getStatus();
    }

    public function testDoorIsNotOpen()
    {
        $cabinet = $this->addShelves(new Cabinet());
        $drink = new Drink('Sprite');
        $cabinet->put($drink);
    }

    public function testCannotBePut()
    {
        $cabinet = new Cabinet();
        $cabinet->openDoor();
        $cabinet = $this->addShelves($cabinet);

        $drink = new Drink('Sprite');
        for ($i = 0; $i < 60; $i++) {
            $cabinet->put($drink);
        }

        $cabinet->put(new Drink('Sprite'));
    }

    public function testCannotBeTake()
    {
        $cabinet = new Cabinet();
        $cabinet->openDoor();
        $cabinet = $this->addShelves($cabinet);
        $cabinet->take();
    }
}