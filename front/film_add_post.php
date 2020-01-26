<?php
	
include_once 'curl.php';


$tytul = $_POST['tytul'];
$rezyser = $_POST['rezyser'];
$opis = $_POST['opis'];

//porównanie haseł

$ch = new ClientURL();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$url = 'http://localhost:8080/WM/projekt/Projekt-WM/API/film/create.php';

$arrayData = array('tytul' => $tytul, 'rezyser' => $rezyser, 'opis' => $opis);
// var_dump($arrayData);
$dataToAppi = json_encode($arrayData);
// var_dump($dataToAppi);
$ch->setPostURL($url, $dataToAppi);
$wynik = $ch->exec();
// var_dump($wynik);
$json = json_decode($wynik, TRUE);

if($json['message']){
    header('Location: index.php');
}else{
	header('Location: film_add.php');
}