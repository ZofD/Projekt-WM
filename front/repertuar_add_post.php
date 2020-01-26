<?php
	
include_once 'curl.php';


$film = $_POST['film'];
$id_sali = $_POST['id_sali'];
$date = $_POST['date'];

//porównanie haseł

$ch = new ClientURL();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$url = 'http://localhost:8080/WM/projekt/Projekt-WM/loadingPages/repertuar/create.php';

$arrayData = array('film' => $film, 'id_sali' => $id_sali, 'date' => $date);
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
	header('Location: repertuar_add.php');
}