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

$film = new Film($db);

try{
    $data = json_decode(file_get_contents('php://input'), TRUE);

    $film->id_filmu = $data['id_filmu'];

    //utworz uzytkownika
    if($film->deleteFilmById()){
        echo json_encode(array('odp' => TRUE));
    }else{
        echo json_encode(array('odp' => FALSE));
    }
}catch(Exception $e){
    echo json_encode(array('odp' => $e->getMessage()));
}