<?php

include 'dbconfig.php';

// Connect to database
$con = @mysql_connect("localhost:3306",$dbuser,$dbpasswd,FALSE,MYSQL_CLIENT_INTERACTIVE);
if (!$con)
	{
	die("");
	}

mysql_query("SET interactive_timeout=10");
  
mysql_select_db("itamuslinks", $con);

?>