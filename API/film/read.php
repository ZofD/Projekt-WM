<?php
    //naglowek
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once './../config/Database.php';
    include_once './../models/Film.php';

    //inicjalizacja polaczenia z baza danych
    $database = new Database();
    $db = $database->connect();

    //inicjalizacja obiektu User
    $film = new Film($db);

    //User zapytanie
    $result = $film->getFilmAll();

    //pobierz wiersz zapytania
    $num = $result->rowCount();

    //sprawdz czy uzytkownicy istnieja
    if($num > 0){
        //tablica uzytkownikow
        $film_arr = array();
        $film_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $film_item = array(
                'id_filmu' => $id_filmu,
                'tytul' => $tytul,
                'rezyser' => $rezyser,
                'opis' => $opis
            );

            //umiesc w "data"
            array_push($film_arr['data'], $film_item);
        }

        //umiesc w JSON i wyrzuc
        echo json_encode($film_arr);
    }else{
        //nie ma uzytkownikow
        echo json_encode(
            array('massage' => 'No User found')
        );
    }