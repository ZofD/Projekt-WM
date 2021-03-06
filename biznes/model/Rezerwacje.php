<?php
include_once 'Walidacja.php';
class Rezerwacje{
    var $Repertuar;
    var $imie;
    var $nazwisko;
    var $miejsca;
    var $iloscUczen;
    var $iloscStudent;

    public function __construct($Repertuar,$imie, $nazwisko, $miejsca, $iloscUczen, $iloscStudent){ //obiekt jest tworzony przed 
        Walidacja::walidacjaString($imie);                                                          //podaniem rodzaju biletu
        Walidacja::walidacjaString($nazwisko);
        Walidacja::walidacjaTablicyInt($miejsca);
        Walidacja::walidacjaUlgi($miejsca, $iloscStudent, $iloscUczen);
        $this->Repertuar = $Repertuar;
        $this->imie = $imie;
        $this->nazwisko = $nazwisko;
        $this->miejsca = $miejsca;
        $this->iloscUczen = $iloscUczen;
        $this->iloscStudent = $iloscStudent;
    }

    public function __destruct(){
        
    }

    function getRepertuar(){
        return $this->Repertuar;
    }

    function getImie(){
        return $this->imie;
    }

    function getNazwisko(){
        return $this->nazwisko;
    }

    function getMiejca(){
        return $this->miejsca;
    }

    public function rezerwuj($idRepertuar, $miejsca){                           //funkcja jesli ma dostep do pliku i podane miejsca nie są zajete 
        $rezerwacje = json_decode(file_get_contents("miejsca.json"), TRUE);     //zapisuje dane do pliku z stanem 0 czyli wstepnie zajete
        $miejsca[] = 0;
        $k = 1;
        $id = 0;
        for($l = 0; $l < sizeof($rezerwacje); $l++){
            if($rezerwacje[$l][0] == $idRepertuar){
                for($i = 0; $i < sizeof($miejsca) - 1; $i++){
                    for($j = 0; $j < sizeof($rezerwacje[$l], 1) - 3; $j++){
                        if($miejsca[$i] == intval($rezerwacje[$l][1][$j])){
                            $k = 0;
                            break;
                        }
                    }
                    if($k == 0) break;
                }
            }
            $id = $l + 1;
            if($k == 0) break;
        }
        
        if($k == 1){
            $rezerwacje[] = [$idRepertuar, $miejsca];
            $rezerwacje = json_encode($rezerwacje);
            file_put_contents("miejsca.json", $rezerwacje);
            return $id;
        }else return -1;
    }

    function obliczCene($cenyBiletow, $dzien){    //funkcja podaje cene rezerwacji przy podsumowaniu
        $cena = 0.00;
        $ulgaSzkolna = $cenyBiletow->getSzkolne();
        $ulgaStudencka = $cenyBiletow->getStudenckie();
        $dni = $cenyBiletow->getCeny();
        $cena += $dni[$dzien] * (count($this->miejsca) - $this->iloscUczen - $this->iloscStudent);
        $cena += $dni[$dzien] * $ulgaSzkolna * $this->iloscUczen;
        $cena += $dni[$dzien] * $ulgaStudencka * $this->iloscStudent;
        return round($cena,2);
    }

    function potwierdz($id){    //funkcja zmienia stan z 0 na 1 czyli zarezerwowane 
        $rezerwacje = json_decode(file_get_contents("miejsca.json"), TRUE);
        $dana = $rezerwacje[$id];
        $rezerwacje[$id][1][sizeof($dana, 1) - 3] = 1;
        $rezerwacje = json_encode($rezerwacje);
        file_put_contents("miejsca.json", $rezerwacje);

        return TRUE;
    }

    function anuluj($id){                                                       //funkcja nadaje idRepertuaru na -1 co skutkuje 
        $rezerwacje = json_decode(file_get_contents("miejsca.json"), TRUE);     //nie braniem tego rekordu pod uwage w przyszlosci
        $rezerwacje[$id][0] = -1;
        $rezerwacje = json_encode($rezerwacje);
        file_put_contents("miejsca.json", $rezerwacje);

        return TRUE;
    }
}
?>