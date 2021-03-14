<?php

namespace Storage;

use Drink\DrinkInterface;
use Exception;
use Shelf\CabinetShelf;
use Shelf\ShelfInterface;
use Util\CabinetStatus;
use Util\DoorStatus;

class Cabinet implements StorageInterface
{
    /** @var CabinetShelf[] */
    private $shelves;

    /** @var string */
    private $cabinetDoor = DoorStatus::CLOSE;

    /** @var string */
    private $cabinetStatus = CabinetStatus::EMPTY;

    public function addShelf(CabinetShelf $shelf)
    {
        $this->checkDoor();
        $this->shelves[] = $shelf;
    }

    public function closeDoor()
    {
        $this->cabinetDoor = DoorStatus::CLOSE;
    }

    public function openDoor()
    {
        $this->cabinetDoor = DoorStatus::OPEN;
    }

    private function checkDoor()
    {
        if ($this->cabinetDoor != DoorStatus::OPEN) {
            throw new Exception('The door is not open!');
        }
    }

    public function put(DrinkInterface $drink): DrinkInterface
    {
        $this->checkDoor();
        foreach ($this->shelves as $shelf) {
            try {
                return $shelf->put($drink);
            } catch (\Exception $e) {
                continue;
            }
        }

        throw new \Exception('The cabinet is ' . CabinetStatus::FULL);
    }

    public function take(): DrinkInterface
    {
        $this->checkDoor();
        foreach ($this->shelves as $shelf) {
            try {
                return $shelf->take();
            } catch (\Exception $e) {
                continue;
            }
        }

        throw new \Exception('The cabinet is ' . CabinetStatus::EMPTY);
    }

    public function getStatus(): string
    {
        $totalCapacity = array_sum(
            array_map(function (ShelfInterface $shelf) {
                return $shelf->capacity();
            }, $this->shelves)
        );

        $totalDrinkCount = array_sum(
            array_map(function (ShelfInterface $shelf) {
                return $shelf->count();
            }, $this->shelves)
        );

        if ($totalDrinkCount == $totalCapacity) {
            $this->cabinetStatus = CabinetStatus::FULL;
        } else if ($totalDrinkCount > 0) {
            $this->cabinetStatus = CabinetStatus::PARTIAL_FULL;
        } else {
            $this->cabinetStatus = CabinetStatus::EMPTY;
        }

        return $this->cabinetStatus;
    }
}