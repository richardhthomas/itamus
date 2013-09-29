<?php

session_start();

// connect to database	
include 'dbconnectpdo.php';

// change password
$pwd = $_POST['password1'];
$uc = $_SESSION['usercode'];
$stmt = $dbConnection->prepare('UPDATE users SET password= :pwd WHERE usercode= :uc');
$stmt->bindParam(':pwd', $pwd);
$stmt->bindParam(':uc', $uc);
$stmt->execute();

$dbConnection = null;

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
<a id="homelink" href="logout.php">Log-out</a>
<br />
<a id="homelink" href="acchomepage.php">Home</a>
</div>

<div class="acchp1">
<p>Your password has been changed</p>
</div>

<?php
include 'bottombar.php';
?>

</div>

</body>
</html>