<?php
    //naglowek
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once './../config/Database.php';
    include_once './../models/RezerwacjeMiejsca.php';

    //inicjalizacja polaczenia z baza danych
    $database = new Database();
    $db = $database->connect();

    //inicjalizacja obiektu User
    $rezMie = new RezerwacjeMiejsca($db);

    try{
        $data = json_decode(file_get_contents('php://input'), TRUE);
    
        // $user->id = $data->id;
        $rezMie->id_rezerwacjiFKRezMie = $data['idRezerwacji'];

        $result = $rezMie->getRezerwacjaMiejscaById();

        $num = $result->rowCount();

        if($num > 0){
            //tablica uzytkownikow
            $rez_arr = array();
            $rez_arr['miejsca'] = array();
    
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                extract($row);
    
                //umiesc w "data"
                array_push($rez_arr['miejsca'], $row['id_miejsca']);
            }
    
            echo json_encode($rez_arr);
        }else{
            echo json_encode(
                array('odp' => FALSE)
            );
        }
    }catch(Exception $e){
        echo json_encode(array('odp' => $e->getMessage()));
    }