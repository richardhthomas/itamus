<?php

// connect to database	
include 'dbconnect.php';

// Read the number of users into $nou['COUNT(id)']
$sql = "SELECT COUNT(id) FROM respcodes";
$result = mysql_query($sql);
$nou = mysql_fetch_array($result);

// read the usercodes and respcodes from the database into an array
$sql = "SELECT * FROM respcodes";
$result = mysql_query($sql);

for ($x=1; $x<=$nou['COUNT(id)']; $x++)
	{
	$row[$x] = mysql_fetch_array($result);
	}

mysql_close($con);


// connect to database using PDO set-up
include 'dbconnectpdo.php';

// check the resp code passed from the 360fbform against the array - this ensures that the respondent hasn't gone back in their browser and made alterations to the form then submitted it a second time (as the resp code is deleted at the end of this routine so will not be present a second time)
for ($a=1; $a<=$nou['COUNT(id)']; $a++)
	{
	for ($b=1; $b<=25; $b++)
		{
		$resp = "r" . $b;
		if ($row[$a]["$resp"] == $_POST['rc'])
			{
			// Write form results to database
			$date = date("Y/m/d");
			$usercode = $row[$a]['usercode'];
			
			$sql = "INSERT INTO msftable (usercode, date";
			for ($x=1; $x<=26; $x++)
				{
				if ($x<=9)
					{
					$sql = $sql . ", q0$x";
					}
				else
					{
					$sql = $sql . ", q$x";
					}
				}
		
			$sql = $sql . ", q23a, q23b, q26a) VALUES (:usercode, :date";
			for ($x=1; $x<=26; $x++)
				{
				$qn = ":q$x";
				$sql = $sql . ", $qn";
				}
			$sql = $sql . ", :q23a, :q23b, :q26a)";

			// These if statements ensure that there are no 'null' variables as the PDO class won't accept these
			if (!isset($_POST['q23a']))
				$_POST['q23a'] = "";
			if (!isset($_POST['q23b']))
				$_POST['q23b'] = "";
			if (!isset($_POST['q26a']))
				$_POST['q26a'] = "";
			
			// Assign PDO object
			$stmt = $dbConnection->prepare("$sql");
			
			for ($x=1; $x<=26; $x++)
				{
				$q = "q$x";
				$qn = ":q$x";
				$stmt->bindParam($qn, $_POST["$q"]);
				}
			
			$stmt->bindParam(":usercode", $usercode);
			$stmt->bindParam(":date", $date);
			$stmt->bindParam(":q23a", $_POST["q23a"]);
			$stmt->bindParam(":q23b", $_POST["q23b"]);
			$stmt->bindParam(":q26a", $_POST["q26a"]);
			
			$stmt->execute();
			
			// update the resp code that has just been used so it can't be re-used
			$newcode = $row[$a]["$resp"] . "xxx";
			$stmt = $dbConnection->prepare("UPDATE respcodes SET $resp='$newcode' WHERE usercode= :usercode");
			$stmt->bindParam(":usercode", $usercode);
			$stmt->execute();
			
			}
		}
	}

$dbConnection = null;

?>

<!DOCTYPE html>

<html>

<head>

<link rel="stylesheet" type="text/css" href="fbstylesheet.css" /> 

</head>

<body>

<div id='container'>

<div id="header">
<h1>itamus.com</h1>
</div>

<div id="headerright">
</div>

<table class="respregtab2">
	<tr>
		<td class="respreg1">Your response has been submitted - many thanks for your time.</td>
	</tr>
	<tr>
		<td class="respreg2">You can now close this browser window if you wish.</td>
	</tr>
</table>

</div>

</body>
</html>
