<?php

$initial_depth = 60; // height of the tank
$measured_depth = 50.42; // height of the liquid in the tank

$percentage_full = round(($measured_depth / $initial_depth) * 100, 2);

echo $percentage_full;
