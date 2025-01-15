<?php
error_reporting(E_ALL); 
include_once 'config/Configuration.php';

spl_autoload_register(function($class){
    $file = __DIR__ . '/Engine/' . $class . '.php';

    if(file_exists($file)){
        include_once $file;
    }
});

$db = Database::getInstance();
$relayClass = new Relay();
$relays = [
    $relayClass->getRelayById(1),
    $relayClass->getRelayById(2),
    $relayClass->getRelayById(3),
];
