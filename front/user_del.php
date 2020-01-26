<?php

session_start();
	
	if (!isset($_SESSION['inicjuj']))
	{
		session_regenerate_id();
		$_SESSION['inicjuj'] = true;
		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
    }

include_once 'curl.php';

$id_uzytkownika = $_POST["id_uzytkownika"];
$id_uzytkownika = intval($id_uzytkownika);
// var_dump($id_uzytkownika);


$ch = new ClientURL();


$url = 'http://localhost:8080/WM/projekt/Projekt-WM/API/uzytkownicy/delete.php';
$arrayData = array('id_uzytkownika' => $id_uzytkownika);
$dataToAppi = json_encode($arrayData);
// var_dump($dataToAppi);
$ch->setPostURL($url, $dataToAppi);
$wynik = $ch->exec();

$json = json_decode($wynik, TRUE);

if($json['odp']){
    header('Location: Panel_Admina.php');
}else{
	header('Location: index.php');
}