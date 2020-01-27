<?php
session_start();

include_once 'curl.php';
include_once 'fpdf.php';

// $url = 'http://localhost:8080/WM/projekt/Projekt-WM/loadingPages/repertuar/read_single.php';
$urlBiznes1 = 'http://localhost:8080/WM/projekt/Projekt-WM/biznes/instruction/potwierdz.php';
$urlBiznes2 = 'http://localhost:8080/WM/projekt/Projekt-WM/biznes/instruction/drukuj.php';

$ch = new ClientURL();

// $ch->setPostURL($url, $wyslij);
// $rezult = $ch->exec();

$wyslij['id'] = intval($_GET['id']);
$index = intval($_GET['index']);

$dataRep = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['dataRep']);

$listonosz['data'] = $_SESSION['tytul'];//tytul
$listonosz['godz'] = intval($dataRep->format('H'));
$listonosz['min'] = intval($dataRep->format('i'));
$listonosz['miesiac'] = intval($dataRep->format('m'));
$listonosz['dzien'] = intval($dataRep->format('d'));
$listonosz['rok'] = intval($dataRep->format('Y'));
$listonosz['idSali'] = intval($_SESSION['idSali']);
$listonosz['imie'] = $_SESSION['imieRez'];
$listonosz['nazwisko'] = $_SESSION['nazwiskoRez'];
$listonosz['miejsca'] = $_SESSION['miejscaRez'];
$listonosz['iloscUczen'] = intval($_SESSION['iloscSzkolneRez']);
$listonosz['iloscStudent'] = intval($_SESSION['iloscStudentRez']);
$listonosz['idRepertuaru'] = $wyslij['id'];
$listonosz['idUzytkownika'] = intval($_SESSION['idUzytkownika']);
$listonosz['indexMiejscaTab'] = $index;
$listonosz['admin'] = intval($_SESSION['admin']);
$listonosz['cena'] = $_SESSION['cenaRez'];

if(isset($_POST['zatwierdz'])){ 
    $listonosz['idRezerwacji'] = intval($_GET['idRezerwacji']);
    $listonosz['akcja'] = 0;
    var_dump($listonosz);
//     $ch->setPostURL($urlBiznes1, $listonosz);
//     $fromBiznes = $ch->exec();
//     $fromBiznes = json_decode($fromBiznes, TRUE);
//     if($fromBiznes['odp']){
//         header('Location: index.php');
//     }else{
//         header('Location: podsumowanie.php?id='.$wyslij['id'].'&index='.$index);
//     }
// }

// if(isset($_POST['drukuj'])){
//     $listonosz['akcja'] = 1;
//     $ch->setPostURL($urlBiznes2, $listonosz);
//     $fromBiznes = $ch->exec();
//     $bilet = json_decode($fromBiznes, TRUE);
//     if($bilet['odp']) var_dump($bilet['bilet']);
//     header('Location: podsumowanie.php?id='.$wyslij['id'].'&index='.$index);
// }

// if(isset($_POST['anuluj'])){
//     $listonosz['akcja'] = 2;
//     $ch->setPostURL($urlBiznes1, $listonosz);
//     $fromBiznes = $ch->exec();
//     $fromBiznes = json_decode($fromBiznes, TRUE);
//     if($fromBiznes['odp']){
//         header('Location: index.php');
//     }else{
//         header('Location: podsumowanie.php?id='.$wyslij['id'].'&index='.$index);
//     }
}
?>