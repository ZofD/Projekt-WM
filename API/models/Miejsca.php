<?php

class Miejsca{
    //baza
    private $conn;
    private $table = 'sala';

    public $id_miejsca;
    public $id_saliFKMie;

    public function __construct($db){
        $this->conn = $db;
    }

    //funkcje z SQL...
}