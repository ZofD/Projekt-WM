<?php
require('../fpdf.php');
include_once 'curl.php';

session_start();

class PDF extends FPDF
{
// Page header
function header(){
        $this->Ln(20);
        $this->SetFont('Arial','B',14);
        $this->Cell(185,5,'BILET KINOWY',0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','',12);
        $this->Cell(185,10,'Dane Kupujacych',0,0,'C');
        $this->Ln(20);
}
function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Strona' .$this->PageNo().'/{nb}',0,0,'C');               
    }
    function headerTable(){
        $this->SetFont('Arial','B',10);
        $this->Cell(40,10,'Imie',1,0,'C');
        $this->Cell(40,10,'Nazwisko',1,0,'C');
        $this->Cell(20,10,'Sala',1,0,'C');
        $this->Cell(90,10,'Film',1,0,'C');
        $this->Ln();
    }

    function mainTable1(){
        $this->SetFont('Arial','',10);
        $miejsca = " ";
        $miejsca2 = " ";
        $zwykly = sizeof($_SESSION['miejscaRez']) - $_SESSION['iloscSzkolneRez'] - $_SESSION['iloscStudentRez'];
        foreach($_SESSION['miejscaRez'] as $m => $dane) $miejsca .= $dane.", ";
        foreach($_SESSION['miejscaRez'] as $m => $dane) $miejsca2 .= $dane."";
        $this->Cell(100,10,$miejsca,1,0,'C');
        $this->Cell(20,10,$zwykly,1,0,'C');
        $this->Cell(20,10,$_SESSION['iloscSzkolneRez'],1,0,'C');
        $this->Cell(20,10,$_SESSION['iloscStudentRez'],1,0,'C');
        $this->Cell(30,10,$_SESSION['cenaRez'],1,0,'C');
        $this->Ln(30);
        $idBilet = $miejsca2."".round($_SESSION['cenaRez'])."".$_SESSION['idRepertuaru'];
        $this->Cell(30,10,$idBilet,0,0,'C');
    }

    function headerTable1(){
        $this->SetFont('Arial','B',10);
        $this->Cell(100,10,'Miejsca',1,0,'C');
        $this->Cell(20,10,'Zwykly',1,0,'C');
        $this->Cell(20,10,'Szkolny',1,0,'C');
        $this->Cell(20,10,'Studencki',1,0,'C');
        $this->Cell(30,10,'Cena',1,0,'C');
        $this->Ln();
    }

    function mainTable(){
        $this->SetFont('Arial','',10);
        $this->Cell(40,10,$_SESSION['imieRez'],1,0,'C');
        $this->Cell(40,10,$_SESSION['nazwiskoRez'],1,0,'C');
        $this->Cell(20,10,$_SESSION['idSali'],1,0,'C');
        $this->Cell(90,10,$_SESSION['tytul'],1,0,'C');
        $this->Ln();
    }
}

// Instanciation of inherited class

$urlBaza = 'http://localhost:8080/WM/projekt/Projekt-WM/API/rezerwacje/bilet.php';
$ch = new ClientURL();
$ch->setPostURL($urlBaza, json_encode(array('idRezerwacji' => $_SESSION['idRezerwacji']))); 
$rez = $ch->exec();

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'a5', 0);
$pdf->SetFont('Arial','',12);
$pdf->headerTable();
$pdf->maintable();
$pdf->headerTable1();
$pdf->maintable1();

$pdf->Output();
?>
