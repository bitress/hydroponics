<?php

include_once 'init.php';
$cycles = new Cycles();
echo json_encode($cycles->getCyclesBySensorId(1));