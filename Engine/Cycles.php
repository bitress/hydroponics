<?php

class Cycles {

    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function create($sensor_id, $interval, $duration)
    {
        
    }

}