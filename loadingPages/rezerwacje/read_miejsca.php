<?php

$id_rep = json_decode(file_get_contents('php://input'), TRUE);
$id_rep = $id_rep['idRepertuaru'];

$arr_data = file_get_contents("miejscaLP.json");
$arr_data = json_decode($arr_data, true);

// var_dump($arr_data);

$wynik = array();

for($i = 0; $i < count($arr_data);$i++){
    if($arr_data[$i][0] == $id_rep){
        // var_dump($arr_data[$i]);
        for($j = 0; $j < count($arr_data[$i][1])-1; $j++){
            array_push($wynik, $arr_data[$i][1][$j]);
        }
    }
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

echo json_encode($wynik);