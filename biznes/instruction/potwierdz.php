<?php

    include_once './../curl.php';
    include_once './../model/Repertuar.php';
    include_once './../model/Rezerwacje.php';
    include_once './../model/Ceny.php';

    $ch = new ClientURL();
    $url = 'http://localhost:8080/WM/projekt/Projekt-WM/interfejs/podsumowanie.php';
    $urlBaza1 = 'http://localhost:8080/WM/projekt/Projekt-WM/API/rezerwacje/create.php';  
    $urlBaza2 = 'http://localhost:8080/WM/projekt/Projekt-WM/API/rezerwacje/bilet.php';

    //odebranie danych
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
    $listonosz = json_decode(file_get_contents('php://input'), TRUE);

    foreach($listonosz['miejsca'] as $r => $dane) $miejsca [] = intval($dane);

    $data = $listonosz['data'];
    $godzina = intval($listonosz['godz']);
    $minuta = intval($listonosz['min']);
    $miesiac = intval($listonosz['miesiac']);
    $dzien = intval($listonosz['dzien']);
    $rok = intval($listonosz['rok']);
    $sala = intval($listonosz['idSali']);
    $imie = $listonosz['imie'];
    $nazwisko = $listonosz['nazwisko'];
    $iloscUczen = intval($listonosz['iloscUczen']);
    $iloscStudent = intval($listonosz['iloscStudent']);
    $idRepertuar = intval($listonosz['idRepertuaru']);
    $idUzytkownika = intval($listonosz['idUzytkownika']);
    $id = intval($listonosz['indexMiejscaTab']);
    $admin = intval($listonosz['admin']);
    $akcja = intval($listonosz['akcja']);
    $idRezerwacji = intval($listonosz['idRezerwacji']);
    $cena = intval($listonosz['cena']);

    $Repertuar = new Repertuar($data, $godzina, $minuta, $miesiac, $dzien, $rok, $sala);
    $Rezerwacja = new Rezerwacje($Repertuar, $imie, $nazwisko, $miejsca, $iloscUczen, $iloscStudent);

    if($akcja == 2){
        $Rezerwacja->anuluj($id);

        echo json_encode(array('odp' => TRUE));
    }else{
        $Rezerwacja->potwierdz($id);

        if($idRezerwacji < 0){
            $wyslij['idUzytkownika'] = $idUzytkownika;
            $wyslij['idRepertuaru'] = $idRepertuar;
            $wyslij['iloscUczen'] = $iloscUczen;
            $wyslij['iloscStudent'] = $iloscStudent;
            if($admin == 0) $wyslij['bilet'] = 0;
            else $wyslij['bilet'] = 1;
            $wyslij['miejsca'] = $miejsca;
            $wyslij['cena'] = $cena;

            $ch->setPostURL($urlBaza1, json_encode($wyslij));
            $result = $ch->exec();

            $odpAPI = json_decode($result, TRUE);

            if($odpAPI['Rezerwacja']){
                echo json_encode(array('odp' => TRUE, 'idRezerwacji' => $odpAPI['idRezerwacji']));
            }else{
                echo json_encode(array('odp' => FALSE));
            }
        }else{
            $ch->setPostURL($urlBaza2, json_encode(array('idRezerwacji' => $idRezerwacji)));
            $result = $ch->exec();
        }
    }

?>