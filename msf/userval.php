<?php

// connect to database	
include 'dbconnect.php';

// Read the number of users into $nou['COUNT(id)']
$sql = "SELECT COUNT(id) FROM users";
$result = mysql_query($sql);
$nou = mysql_fetch_array($result);

// read the user details from the database into an array
$sql = "SELECT usercode,username,password,firstname,surname FROM users";
$result = mysql_query($sql);

for ($x=1; $x<=$nou['COUNT(id)']; $x++)
	{
	$row[$x] = mysql_fetch_array($result);
	}

mysql_close($con);

for ($a=1; $a<=$nou['COUNT(id)']; $a++)
	{
	if ($row[$a]['username'] == $_POST['username'] && $row[$a]['password'] == $_POST['password'])
		{
		session_start();
		$_SESSION['usercode'] = $row[$a]['usercode'];
		$_SESSION['firstname'] = $row[$a]['firstname'];
		$_SESSION['surname'] = $row[$a]['surname'];
		header("Location: acchomepage.php");
		exit();
		}
	}
	
$head = "usernotfound.php";
header("Location: $head");	
	
?>