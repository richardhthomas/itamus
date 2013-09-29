<?php

$username = "itamuslinks";
$dbpasswd = "Trundl37";

// Connect to database
$dbConnection = new PDO('mysql:host=127.0.0.1;dbname=itamuslinks', $username, $dbpasswd);

$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>