<?php

session_start();
	
	if (!isset($_SESSION['inicjuj']))
	{
		session_regenerate_id();
		$_SESSION['inicjuj'] = true;
		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
    }

include_once 'curl.php';

var_dump($_POST);
$id_filmu = $_POST["id_filmu"];
$id_filmu = intval($id_filmu);
// var_dump($id_filmu);


$ch = new ClientURL();


$url = 'http://localhost:8080/WM/projekt/Projekt-WM/API/film/delete.php';
$arrayData = array('id_filmu' => $id_filmu);
$dataToAppi = json_encode($arrayData);
// var_dump($dataToAppi);
$ch->setPostURL($url, $dataToAppi);
$wynik = $ch->exec();

$json = json_decode($wynik, TRUE);

if($json['odp']){
    header('Location: Dodawanie_filmu.php');
}else{
	header('Location: index.php');
}