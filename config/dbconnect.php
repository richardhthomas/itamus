<?php
    $url=parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"],1);

    mysql_connect($server, $username, $password);
    
    mysql_select_db($db);
?>

<?php
/*
include 'dbconfig.php';

// Connect to database
$con = @mysql_connect("localhost:3306",$dbuser,$dbpasswd,FALSE,MYSQL_CLIENT_INTERACTIVE);
if (!$con)
	{
	echo "Sorry - our server is temporarily unavailable."
	}

mysql_select_db("itamuslinks", $con);
*/
?>