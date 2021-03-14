<?php

namespace Shelf;

use Storage\StorageInterface;

interface ShelfInterface extends StorageInterface
{
    public function capacity(): int;

    public function count(): int;
}