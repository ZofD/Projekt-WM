<?php
    //naglowek
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once './../config/Database.php';
    include_once './../models/Rezerwacja.php';

    //inicjalizacja polaczenia z baza danych
    $database = new Database();
    $db = $database->connect();

    //inicjalizacja obiektu User
    $rez = new Rezerwacja($db);

    //User zapytanie
    $result = $rez->getForPracownik();

    //pobierz wiersz zapytania
    $num = $result->rowCount();

    //sprawdz czy uzytkownicy istnieja
    if($num > 0){
        //tablica uzytkownikow
        $rez_arr = array();
        $rez_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $rez_item = array(
                'id' => $id_rezerwacji,
                'bilet' => $bilet,
                'idUzytkownika' => $user_id,
                'iloscUczen' => $ilosc_uczen_senior,
                'iloscStudent' => $ilosc_student,
                'idRepertuaru' => $id_repertuaru,
                'cena' => $cena,
                'imie' => $imie,
                'nazwisko' => $nazwisko
            );

            //umiesc w "data"
            array_push($rez_arr['data'], $rez_item);
        }

        //umiesc w JSON i wyrzuc
        echo json_encode($rez_arr);
    }else{
        //nie ma uzytkownikow
        echo json_encode(
            array('massage' => 'No Rezerwacje found')
        );
    }