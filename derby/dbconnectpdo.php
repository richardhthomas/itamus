<?php

$username = "b622f81b316c59";
$dbpasswd = "5e8c4975";

// Connect to database
$dbConnection = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_238d97b04de7d86', $username, $dbpasswd);

$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>