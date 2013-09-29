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
	
// check a resp code against the database and move to the 360fbform if it is found
for ($a=1; $a<=$nou['COUNT(id)']; $a++)
	{
	for ($b=1; $b<=25; $b++)
		{
		$resp = "r" . $b;
		if ($row[$a]["$resp"] == $_POST['respcode'])
			{
			$rc = $_POST['respcode'];
			$head = "360fbform.php?rc=$rc";
			header("Location: $head");
			}
		}
	}
	
?>

<!DOCTYPE html>

<html>

<head>

<link rel="stylesheet" type="text/css" href="fbstylesheet.css" /> 

</head>


<body>

<div id="container">

<div id="header">
<h1>itamus.com</h1>
</div>

<div id="headerright">
</div>

<table class="respregtab2">
	<tr>
	<td class="respreg1">Unfortunately the code you entered has not been recognised!</td>
	</tr>
	<tr>
	<td class="respreg3">There are 3 reasons why this might have occured:</td>
	</tr>
	<tr>
	<td class="respreg3">- You have accidentally mistyped the code. Remember it is case sensitive.</td>
	</tr>
	<tr>
	<td class="respreg3">- You have already submitted feedback about your colleague. Each code can only be used once.</td>
	</tr>
	<tr>
	<td class="respreg3">- The code has expired. This will occur if it is more than 6 months since you were asked to provide feedback.</td>
	</tr>
</table>

<form name="respregform" action="respregprocess.php" method="post">
<table class="respregtab2">
	<tr>
	<td class="respreg1">Please enter your respondent code again if you think it may have been mistyped</td>
	</tr>
	<tr>
	<td class="respreg2"><input type="text" name="respcode" size="12" /></td>
	</tr>
	<tr>
	<td class="respreg2"><input type="submit" value="Next" /></td>
	</tr>
</table>
</form>

</div>

</body>
</html>