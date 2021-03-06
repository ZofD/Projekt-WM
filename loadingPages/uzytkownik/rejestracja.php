<?php

include_once "../model/Uzytkownik.php";
include_once './../curl.php';

$ch = new ClientURL();

$url = 'http://localhost:8080/WM/projekt/Projekt-WM/API/uzytkownicy/create.php';

$user = new Uzytkownik();

$dataFormUser = json_decode(file_get_contents('php://input'));
$dataToAppi = json_encode($dataFormUser);

$ch->setPostURL($url, $dataToAppi);
$rezult = $ch->exec();

$json = json_decode($rezult, true);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
echo json_encode($json);