<?php
require('../fpdf.php');


session_start();
class PDF extends FPDF
{
// Page header
function header(){
        
        $this->SetFont('Arial','B',14);
        $this->Cell(185,5,'BILET KINOWY',0,0,'C');
        $this->Ln();
        $this->SetFont('Times','',12);
        $this->Cell(185,10,'Dane Kupujacych',0,0,'C');
        $this->Ln(20);
}
function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Strona' .$this->PageNo().'/{nb}',0,0,'C');               
    }
    function headerTable(){
        $this->SetFont('Times','B',12);
        $this->Cell(20,10,'Imie',1,0,'C');
        $this->Cell(20,10,'Nazwisko',1,0,'C');
        $this->Cell(20,10,'Miejsce',1,0,'C');
        $this->Cell(20,10,'Ulgowy',1,0,'C');
        $this->Cell(36,10,'Zwykly',1,0,'C');
        $this->Cell(30,10,'Sala',1,0,'C');
        $this->Cell(50,10,'Film',1,0,'C');
        $this->Ln();
    }
	function maintable(){
        $this->SetFont('Times','B',12);
       
        $this->Ln();
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->headerTable(20,10,"Damian",1,0,"C");
$pdf->maintable();

$pdf->Output();
?>
