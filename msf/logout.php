<?php

session_start();
unset($_SESSION['usercode']);
unset($_SESSION['firstname']);
unset($_SESSION['surname']);
session_destroy();

$head = "index.php";
header("Location: $head");

?>