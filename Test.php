<?php

use Test\CabinetTest;

require __DIR__.'/Test/CabinetTest.php';

$cabinetTest = new CabinetTest();

echo $cabinetTest->testFullCabinet()."\n";

echo $cabinetTest->testPartialFullCabinet()."\n";

echo $cabinetTest->testEmptyCabinet()."\n";

try {
    $cabinetTest->testDoorIsNotOpen();
} catch (Exception $e) {
    echo $e->getMessage()."\n";
}

try {
    $cabinetTest->testCannotBePut();
} catch (Exception $e) {
    echo $e->getMessage()."\n";
}

try {
    $cabinetTest->testCannotBeTake();
} catch (Exception $e) {
    echo $e->getMessage()."\n";
}