<?php
    //naglowek
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once './../config/Database.php';
    include_once './../models/Film.php';

    //inicjalizacja polaczenia z baza danych
    $database = new Database();
    $db = $database->connect();

    //inicjalizacja obiektu Repertuar
    $film = new Film($db);

    try{
        $data = json_decode(file_get_contents('php://input'), true);
    
        $film->tytul = $data['tytul'];
        $film->rezyser = $data['rezyser'];
        $film->opis = $data['opis'];

        //utworz repertuar
        if($film->create()){
            echo json_encode(array('message' => TRUE));
        }else{
            echo json_encode(array('message' => FALSE));
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }