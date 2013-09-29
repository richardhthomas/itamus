<?php

$username = "msf";
$dbpasswd = "Trundl37";

// Connect to database
$con = @mysql_connect("localhost:3306",$username,$dbpasswd,FALSE,MYSQL_CLIENT_INTERACTIVE);
if (!$con)
	{
	die('Could not connect: ' . mysql_error());
	}

mysql_query("SET interactive_timeout=10");
  
mysql_select_db("msf", $con);

?>