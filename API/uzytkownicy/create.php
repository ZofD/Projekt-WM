<?php
    //naglowek
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once './../config/Database.php';
    include_once './../models/Uzytkownik.php';

    //inicjalizacja polaczenia z baza danych
    $database = new Database();
    $db = $database->connect();

    //inicjalizacja obiektu User
    $user = new Uzytkownik($db);

    try{
        $data = json_decode(file_get_contents('php://input'));
    
        // $user->id = $data->id;
        $user->login = $data->login;
        $user->password = $data->password;
        $user->admin = $data->admin;
        $user->email = $data->email;
        $user->imie = $data->imie;
        $user->nazwisko = $data->nazwisko;
    
        //utworz uzytkownika
        if($user->chechUzytkownikExist()){
            echo json_encode(array('message' => FALSE));
        }
        elseif($user->create()){
            echo json_encode(array('message' => TRUE));
        }else{
            echo json_encode(array('message' => FALSE));
        }
        }catch(Exception $e){
            echo $e->getMessage();
        }