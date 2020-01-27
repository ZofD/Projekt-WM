<?php
include_once 'GenerujBilet.php';
class Bilet extends Rezerwacje{
    var $bilet;

    public function __construct($repertuar,$imie, $nazwisko, $miejsca, $idRepertuar, $idUzytkownika, $sala, $film){   //konstruktor uzywany jesli kupujemy 
        parent::__construct($repertuar,$imie, $nazwisko, $miejsca, $idRepertuar, $idUzytkownika);       //bilet u pani w "okienku"
        $this->bilet = new GenerujBilet($this->imie, $this->nazwisko, $this->miejsca, $this->iloscUczen, $this->iloscStudent, $sala, $film);
    }

    // public function __construct1($rezerwacja){  //konstruktor uzywany jesli potwierdzamy rezerwacje u pani w "okienku"
    //     $repertuar = $rezerwacja->getRepertuar();
    //     $sala = $repertuar->getSala();
    //     $film = $repertuar->getFilm();
    //     $this->bilet = new GenerujBilet(
    //         $rezerwacja->getImie(), $rezerwacja->getNazwisko(), $rezerwacja->getMiejca(), $rezerwacja->getSzkolny(), 
    //         $rezerwacja->getStudencki(), $sala, $film);
    //     $this->zmienStatus();
    // }

    public function __destruct(){
        
    }

    function drukujBilet(){ //funkcja otfiera pdf w nowym oknie
        $this->bilet->AliasNbPages();
        $this->bilet->AddPage();
        $this->bilet->SetFont('Arial','',12);
        // $this->bilet->Output();
        return $this->bilet;
    }
}
?>