<?php

// connect to database	
include 'dbconnect.php';

// Retrieve user details
$usercode = $_POST['usercode'];
$firstname = $_POST['firstname'];
$surname = $_POST['surname'];

// Read the number of respondents into $nor['COUNT(id)']
$sql = "SELECT COUNT(id) FROM msftable WHERE usercode='" . $usercode . "'";
$result = mysql_query($sql);
$nor = mysql_fetch_array($result);


// read the results from the database into an array
$sql = "SELECT * FROM msftable WHERE usercode='" . $usercode . "'";
$result = mysql_query($sql);
for ($x=1; $x<=$nor['COUNT(id)']; $x++)
	{
	$row[$x] = mysql_fetch_array($result);
	}

mysql_close($con);	

/*
// Check if a .pdf file has already been created - if so delete it
$dir = $usercode;
$filename = "$dir/" . $firstname . "_feedback.pdf";
if (file_exists($filename)==TRUE)
	{
	unlink($filename);
	}
*/

$filename = $firstname . "_feedback.pdf";

//setup summary stats - $tally[quest no + code from database] = total for each. Skip q20.
$tally = array();
for ($x=1; $x<=$nor['COUNT(id)']; $x++)
	{
	for ($y=1; $y<=19; $y++)
		{
		// This bit pads out 1-9 as 01-09 so names are all of equal length so can easily be dissected later...
		if ($y<=9)
			{
			$b = "q0$y";
			}
		else
			{
			$b = "q$y";
			}
		$a = $row[$x]["$b"];
		$key = $b . $a;
		$tally["$key"]++;
		}
	for ($y=21; $y<=26; $y++)
		{
		$b = "q$y";
		$a = $row[$x]["$b"];
		$key = $b . $a;
		$tally["$key"]++;
		}
	if ($row[$x]['q23a'] == "y")
		{
		$tally['q23ay']++;
		}
	}

	
// collate 'other' text responses for q23b
$q23otsum = "";
$q23otcount = $tally['q23ot'];
if ($q23otcount>0)
	{
	$q23otsum = "(";
	for ($x=1; $x<=$nor['COUNT(id)']; $x++)
		{
		if ($row[$x]['q23b']!="" && $row[$x]['q23b']!="Please specify")
			{
			$q23otsum = $q23otsum . $row[$x]['q23b'];
			if ($q23otcount == 1)
				{
				$q23otsum = $q23otsum . ")";
				}
			else
				{
				$q23otsum = $q23otsum . ", ";
				}
			$q23otcount--;
			}
		}
	}
$tally['q23ott'] = substr($q23otsum,0,35);


// collate 'other' text responses for q26a
function q26sum($code)
	{
	global $q26otsum, $tally, $nor, $row;
	$key = "q26$code";
	$q26otsum[$code] = "";
	$q26otcount[$code] = $tally["$key"];
	if ($q26otcount[$code]>0)
		{
		$q26otsum[$code] = "(";
		for ($x=1; $x<=$nor['COUNT(id)']; $x++)
			{
			if ($row[$x]['q26']==$code && $row[$x]['q26a']!="" && $row[$x]['q26a']!="Please specify")
				{
				$q26otsum[$code] = $q26otsum[$code] . $row[$x]['q26a'];
				if ($q26otcount[$code] == 1)
					{
					$q26otsum[$code] = $q26otsum[$code] . ")";
					}
				else
					{
					$q26otsum[$code] = $q26otsum[$code] . ", ";
					}
				$q26otcount[$code]--;
				}
			}
		}
	}
q26sum('ow');
q26sum('om');
q26sum('oa');
q26sum('ob');
q26sum('oo');
$tally['q26owt'] = substr($q26otsum['ow'],0,20);
$tally['q26omt'] = substr($q26otsum['om'],0,20);
$tally['q26oat'] = substr($q26otsum['oa'],0,20);
$tally['q26obt'] = substr($q26otsum['ob'],0,20);
$tally['q26oot'] = substr($q26otsum['oo'],0,20);	


// format dates
$firstdate = $row[1]['date'];
$last = $nor['COUNT(id)'];
$lastdate = $row["$last"]['date'];

$firstdateorder[3] = substr($firstdate,0,4);
$firstdateorder[2] = substr($firstdate,5,2);
$firstdateorder[1] = substr($firstdate,8,2);

$lastdateorder[3] = substr($lastdate,0,4);
$lastdateorder[2] = substr($lastdate,5,2);
$lastdateorder[1] = substr($lastdate,8,2);

$dof = $firstdateorder[1] . "/" . $firstdateorder[2] . "/" . $firstdateorder[3] . " - " . $lastdateorder[1] . "/" . $lastdateorder[2] . "/" . $lastdateorder[3];


// Create PDF	

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

/* Load data - see txt files in PDFtext folder - holds info about each row of each table. Each line of the files represents a line of the table, followed by a line which holds any 'codes' associated with each table element (these codes are then used to identify the relevent database data to enter into the table). Format is as follows:
number of physical rows the table row needs (either 1 or 2);text1;text2;text3 etc.; 
If a table row needs 2 physical rows of space then it is represented by 2 lines in these files, each of which needs to begin with a 2. The text is the text that appears in the table.
;code1;code2;code3 etc;
This subsequent line holds the codes for any variable entries that are associated with each text entry above. Note it starts with a ';' as the first term is always null (as it marrys with the number of physical rows mentioned above which cannot have any data entry associated with it).
*/ 
function LoadData($file)
{
    // Read file lines
    $lines = file($file);
	$data = array();
	for ($x=1; $x<=count($lines); $x=$x+2)
	{
	$data[$x] = explode(';',$lines[$x-1]);
	$data[$x+1] = explode(';',$lines[$x]);
	}
    return $data;
}

// Table - Routine for summary tables. $data contains the info from the text files, $ncol is the number of columns, $nrow is the number of PHYSICAL rows (so larger than the number of table rows if any table rows span 2 physical lines) and $w is an array that contains the widths of each column.
function Table($data, $ncol, $nrow, $w)
	{	
    global $tally;
	for ($rn=1; $rn<=(2*$nrow); $rn=$rn+2) //increments by 2 to allow for a 'text' line and a 'code' line for each physical table row.
		{
		// set border attributes for single and double depth cells
		$celldepth = $data[$rn][0];
		if ($celldepth == 1)
			{
			$borl = 'LTB';
			$bort = 'TB';
			$borr = 'TRB';
			}
		elseif ($celldepth == 2 AND $borl != 'LT')
			{
			$borl = 'LT';
			$bort = 'T';
			$borr = 'TR';
			}
		elseif ($celldepth == 2 AND $borl != 'LB')
			{
			$borl = 'LB';
			$bort = 'B';
			$borr = 'BR';			
			}
			
		for ($cn=1; $cn<=$ncol-1; $cn++)
			{
			$this->SetFont('Arial','',10);
			$wt = ($this->GetStringWidth($data[$rn][$cn])) + 3;
			$this->Cell($wt,6,$data[$rn][$cn],$borl);
			$this->SetFont('Arial','B',11);
			$wt = $w[$cn-1] - $wt;
			$key = $data[$rn+1][$cn];
			$this->Cell($wt,6,$tally["$key"],$bort,0);
			}
	
		$this->SetFont('Arial','',10);
		$wt = ($this->GetStringWidth($data[$rn][$ncol])) + 3;
        $this->Cell($wt,6,$data[$rn][$ncol],$borl);
		$key = $data[$rn+1][$ncol];
		if ($key=='q23ott' OR $key=='q26owt' OR $key=='q26omt' OR $key=='q26oat' OR $key=='q26obt' OR $key=='q26oot')
			{
			$fontsize = 8;
			}
		else
			{
			$fontsize = 11;
			}
		$this->SetFont('Arial','B',$fontsize);
		$wt = $w[$ncol-1] - $wt;
		$this->Cell($wt,6,$tally["$key"],$borr,1);
		}
	}
	
// Table - routine for individual responses
function Tableind($data, $ncol, $nrow, $w, $x)// As for previous routine but $x also carries the position in the loop going through each respondent one by one.
	{	
    global $row;
	
	for ($rn=1; $rn<=(2*$nrow); $rn=$rn+2)
		{
		// set border attributes for single and double depth cells
		$celldepth = $data[$rn][0];
		if ($celldepth == 1)
			{
			$borl = 'LTB';
			$bort = 'TB';
			$borr = 'TRB';
			}
		elseif ($celldepth == 2 AND $borl != 'LT')
			{
			$borl = 'LT';
			$bort = 'T';
			$borr = 'TR';
			}
		elseif ($celldepth == 2 AND $borl != 'LB')
			{
			$borl = 'LB';
			$bort = 'B';
			$borr = 'BR';			
			}
			
		for ($cn=1; $cn<=$ncol-1; $cn++)
			{
			$this->SetFont('Arial','',10);
			$wt = ($this->GetStringWidth($data[$rn][$cn])) + 3;
			$this->Cell($wt,5,$data[$rn][$cn],$borl);
			$this->SetFont('Arial','B',11);
			$wt = $w[$cn-1] - $wt;
			// The bit below checks that the code bit of the txt file isn't blank (To avoid trying to use anything null as a key in an array). Then the quest no is extracted from the code to be used is the database $row array to compare the contents of that array with the contents of the latter portion of the code (Which if they macth, means that the database entry is the same as the code at this point in the table, so an X is warranted).
			$content="";
			if ($data[$rn+1][$cn]!="")
				{
				$qno = substr($data[$rn+1][$cn],0,3);
				if (substr($data[$rn+1][$cn],3) == $row[$x][$qno])
					{
					$content="X";
					}
				}
			$this->Cell($wt,5,$content,$bort,0);
			}
	
		$this->SetFont('Arial','',10);
		$wt = ($this->GetStringWidth($data[$rn][$ncol])) + 3;
        $this->Cell($wt,5,$data[$rn][$ncol],$borl);
		$this->SetFont('Arial','B',11);
		$wt = $w[$ncol-1] - $wt;
		$content="";
			if ($data[$rn+1][$ncol]!="")
				{
				$qno = substr($data[$rn+1][$ncol],0,3);
				if (substr($data[$rn+1][$ncol],3) == $row[$x][$qno])
					{
					$content="X";
					}
				}
		$this->Cell($wt,5,$content,$borr,1);
		}
	}
}

// Instanciation of inherited class
$nor = $nor['COUNT(id)'];
$name = 'Dr. ' . $firstname . " " . $surname;

$pdf = new PDF();

$pdf->SetMargins(20,20);

$pdf->AddPage();

// Intro

$pdf->SetFont('Arial','',12);
$pdf->Cell(28,5,'Built upon the');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(54,5,"General Medical Council's");
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,'multi-source feedback tool.',0,1);
$pdf->ln();
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,5,"Feedback for $name",0,1);
$pdf->ln();
$pdf->SetFont('Arial','',12);
$pdf->Cell(47,5,'Number of respondents:');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,5,$nor,0,1);
$pdf->SetFont('Arial','',12);
$pdf->ln();
$pdf->Cell(0,5,"Respondents' characteristics:",0,1);


// Tables

$data = $pdf->LoadData('PDFtext/table1a.txt');
$w = array(85,85);
$pdf->Table($data,2,1,$w);
$pdf->ln();

$data = $pdf->LoadData('PDFtext/table2a.txt');
$w = array(28,28,28,28,28,30);
$pdf->Table($data,6,1,$w);
$pdf->ln();

$data = $pdf->LoadData('PDFtext/table3a.txt');
$w = array(56,57,57);
$pdf->Table($data,3,6,$w);
$pdf->ln();

$data = $pdf->LoadData('PDFtext/table4a.txt');
$w = array(34,34,34,34,34);
$pdf->Table($data,5,10,$w);

$pdf->SetFont('Arial','',12);
$pdf->ln();
$pdf->Cell(0,5,"How recently respondents had been familiar with your practice:",0,1);

$data = $pdf->LoadData('PDFtext/table5a.txt');
$w = array(56,57,57);
$pdf->Table($data,3,2,$w);

$pdf->SetFont('Arial','',12);
$pdf->ln();
$pdf->Cell(0,5,"How often respondents had contact with you during this time:",0,1);

$data = $pdf->LoadData('PDFtext/table6a.txt');
$w = array(42,43,42,43);
$pdf->Table($data,4,1,$w);


//Main summary

$pdf->AddPage();

$pdf->SetFont('Arial','',14);
$pdf->Cell(80,5,"Feedback summary",0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(41,5,"Duration of feedback:",0);
$pdf->Cell(0,5,$dof,0,1);
$pdf->ln();

$data = $pdf->LoadData('PDFtext/table10a.txt');
$w = array(55,17,20,20,19,19,20);
$pdf->Table($data,7,25,$w);
$pdf->ln();

$data = $pdf->LoadData('PDFtext/table8a.txt');
$w = array(70,16,16,17,17,17,17);
$pdf->Table($data,7,6,$w);
$pdf->ln();

$data = $pdf->LoadData('PDFtext/table9a.txt');
$w = array(70,33,33,34);
$pdf->Table($data,4,1,$w);


// Comments summary

$pdf->AddPage();

$q20sum="Comments:\n\n";
for ($x=1; $x<=$nor; $x++)
	{
	if ($row[$x]['q20']!="")
		{
		$q20sum = $q20sum . $row[$x]['q20'] . "\n\n";
		}
	}

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,5,$q20sum,1,'L');


// Loop for each respondent

for ($x=1; $x<=$nor; $x++)
	{
	$pdf->AddPage();
	
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(41,5,'Respondent number:');
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(0,5,$x,0,1);
	
	//format date
	$date = $row[$x]['date'];
	$dateorder[3] = substr($date,0,4);
	$dateorder[2] = substr($date,5,2);
	$dateorder[1] = substr($date,8,2);
	$date = $dateorder[1] . "/" . $dateorder[2] . "/" . $dateorder[3];
	
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(38,5,'Date of completion:');
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(0,5,$date,0,1);
	
	$pdf->ln();
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(0,5,'Please rate your colleague in each of the following areas by selecting one response from each line.',0,1);
	$pdf->ln();
	
	$data = $pdf->LoadData('PDFtext/table10a.txt');
	$w = array(55,17,20,20,19,19,20);
	$pdf->Tableind($data,7,25,$w,$x);
	$pdf->ln();
	
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(0,5,'Please decide how far you agree with the following statements by selecting one response on each line.',0,1);
	$pdf->ln();
	
	$data = $pdf->LoadData('PDFtext/table8a.txt');
	$w = array(70,16,16,17,17,17,17);
	$pdf->Tableind($data,7,6,$w,$x);
	$pdf->ln();
	
	$data = $pdf->LoadData('PDFtext/table9a.txt');
	$w = array(70,33,33,34);
	$pdf->Tableind($data,4,1,$w,$x);	
	
	$pdf->AddPage();
	
	$pdf->SetFont('Arial','',10);
	$pdf->MultiCell(0,5,$row[$x]['q20'],1,'L');
	
	}

$pdf->Output($filename,D);

?>