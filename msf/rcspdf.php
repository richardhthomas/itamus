<?php

// connect to database	
include 'dbconnect.php';

// get the relevent line of respondent codes from the database
$sql = "SELECT * FROM respcodes WHERE usercode='" . $_POST['usercode'] . "'";
$query = mysql_query($sql);
$result = mysql_fetch_array($query);

mysql_close($con);


/* Check if an .pdf file has already been created - if so skip to the bottom and just download it
$dir = $result['usercode'];
$filename = "$dir/" . $_POST['firstname'] . "_invitations.pdf";
if (file_exists("$filename")===FALSE)
	{
	$old = umask(0); 
	mkdir($dir,0777); 
	umask($old);
*/

$filename = $_POST['firstname'] . "_invitations.pdf";

//Create pdf

require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    $this->SetFont('Arial','B',34);
    $this->Cell(0,14,'itamus.com',TLR,1);
	$this->SetFont('Arial','',8);
	$this->Cell(0,4,'POWERING ANONYMOUS MULTI-SOURCE FEEDBACK',LR,1);
	$this->Cell(0,4,'PROVIDING EASY LINKS TO ONLINE HEALTHCARE RESOURCES',BLR,1);
	$y = $this->GetY();
	$ypos = $y + 10;
	$this->SetY($ypos);
}
}

// Instanciation of inherited class
$name = 'Dr. ' . $_POST['firstname'] . " " . $_POST['surname'];

$pdf = new PDF();

$pdf->SetMargins(20,20);
for ($x=1; $x<=25; $x++)
	{
	$rno = "r$x";
	$rcode = substr($result["$rno"],0,10);
	
$pdf->AddPage();

$pdf->SetFont('Arial','',12);

$pdf->Cell(0,5,'Licensed doctors are expected to seek feedback from colleagues and patients and review',LTR,1);
$pdf->Cell(0,5,'and act upon that feedback where appropriate.',LR,1);
$pdf->Cell(0,5,'',LR,1);
$pdf->Cell(0,5,'The purpose of this exercise is to provide doctors with information about their work',LR,1);
$pdf->Cell(0,5,'through the eyes of those they work with and is intended to help inform their further',LR,1);
$pdf->Cell(0,5,'development.',LR,1);
$pdf->Cell(0,5,'',LR,1);
$pdf->Cell(30,5,'Your colleague ',L);
$pdf->SetFont('Arial','B',14);
$w = $pdf->GetStringWidth($name)+3;
$pdf->Cell($w,5,$name);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,'would appreciate some feedback. This is a',R,1);
$pdf->Cell(0,5,'completely anonymous process.',LR,1);
$pdf->Cell(0,5,'',LR,1);
$pdf->Cell(0,5,'Please:',LR,1);
$pdf->Cell(15,5,'',L);
$pdf->Cell(42,5,'- go to the web page:');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,5,'www.itamus.com/msf/',R,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(15,5,'',L);
$pdf->Cell(56,5,'- enter the respondent code:');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,5,$rcode,R,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(15,5,'',L);
$pdf->Cell(0,5,'- complete the online feedback form.',R,1);
$pdf->Cell(0,5,'',LR,1);
$pdf->Cell(0,5,'Remember this is a completely anonymous process.',LR,1);
$pdf->Cell(0,5,'',LR,1);
$pdf->Cell(0,5,'Many thanks for your time.',LBR,1);

}

$pdf->Output($filename,D);


?>