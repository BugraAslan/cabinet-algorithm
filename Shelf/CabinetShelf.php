<?php

namespace Shelf;

use Storage\StorageInterface;

class CabinetShelf extends AbstractShelf implements StorageInterface
{
    public function capacity(): int
    {
        return 20;
    }
}