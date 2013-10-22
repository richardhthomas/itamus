<?php

$pass = $_POST['pass'];

if($pass == "osmaston")
{
		session_start();
		$_SESSION['pass'] = "g7f8djbm59weujvbrfuke";
        include("private/surgeryinfo.php");
}

?>