<?php

function usercodechk()
	{
	global $nou, $row, $usercode, $ucfail;
	for ($x=1; $x<=$nou['COUNT(id)']; $x++)
		{
		if ($row[$x]['usercode'] == $usercode)
			{
			$ucfail = TRUE;
			return;
			}
		}
	$ucfail = FALSE;
	}

function respcodechk()
	{
	global $x, $nou, $row, $respcode, $rcfail;
	for ($a=1; $a<=$nou['COUNT(id)']; $a++)
		{
		for ($b=1; $b<=25; $b++)
			{
			$resp = "r" . $b;
			if ($row[$a]["$resp"] == $respcode[$x])
				{
				$rcfail = TRUE;
				return;
				}
			}
		}
	$rcfail = FALSE;
	}

// connect to database	
include '../dbconnect.php';

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

// generate a usercode and check it doesn't already exist
$ucfail = TRUE;
while ($ucfail == TRUE)
	{
	$usercode = mt_rand(10000000,99999999);
	usercodechk();
	}

// generate respondent codes and check they don't exist
for ($x=1; $x<=25; $x++)
	{
	$rcfail = TRUE;
	while ($rcfail == TRUE)
		{
		$respcode[$x] = "";
		for ($y=1; $y<=10; $y++)
			{
			$charno = mt_rand(49,122);
			while (($charno>57 and $charno<65) or ($charno>90 and $charno<97) or $charno==79 or $charno==111 or $charno==73 or $charno==108)
				{
				$charno = mt_rand(49,122);
				}
			$char = chr($charno);
			$respcode[$x] = $respcode[$x] . $char;
			}
		respcodechk();
		}
	}

// connect to database again
include '../dbconnect.php';

// put data in database
$sql = "INSERT INTO users (usercode, username, password, firstname, surname, email) VALUES ($usercode, '$_POST[username]', '$_POST[password1]', '$_POST[firstname]', '$_POST[surname]', '$_POST[email]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "user details added<br />";


$sql = "INSERT INTO respcodes (usercode";
for ($x=1; $x<=25; $x++)
	{
	$sql = $sql . ", r$x";
	}
$sql = $sql . ") VALUES ($usercode";
for ($x=1; $x<=25; $x++)
	{
	$sql = $sql . ", '$respcode[$x]'";
	}
$sql = $sql . ")";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "respondent codes added";

mysql_close($con);

?>