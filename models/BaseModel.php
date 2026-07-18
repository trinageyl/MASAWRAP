<?php

class Base {
    protected $connection;

    function __construct(){
        $this->connection = new mysqli(
            "localhost",
            "root",
            "",
            "db_masawrap"
        );

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }
}