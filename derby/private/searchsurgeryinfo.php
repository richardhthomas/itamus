<!DOCTYPE html>

<?php

session_start();
if ($_SESSION['pass'] == "g7f8djbm59weujvbrfuke")
	{
	echo "<html>

<head>

<title>itamus.com</title>

<link rel='stylesheet' type='text/css' href='stylesheet4.css' /> 

</head>


<body>

<div id='container'>

<div id='header'>
<h1>itamus.com</h1>
</div>

<div id='headerright'>
<a id='homelink' href='index.php' target='_self'>Home</a>
<form method='get' action='searchsurgery.php' target='_self'>
<input type='text' name='search' size='20' />
<input type='submit' value='Search' />
</form>
</div>

<div id='header2search'>
<h3 class='search'>Local surgery - Search results</h3>
</div>

<div id='leftmenusearch'>
</div>";

$page = "searchsurgeryinfo.php?search=" . $_GET['search'];

include 'dbconnectpdo.php';

/*
Build the table
*/

echo "<div id='clintab'>
<table>
<tr>
<th>Name</th>
<th>Phone</th>
<th>Details</th>
</tr>";

$sql = "SELECT name,phone,details,status FROM osmaston WHERE name LIKE :st1 OR details LIKE :st2 OR search LIKE :st3 ORDER BY name";

$searchterm = "%" . $_GET['search'] . "%";

$stmt = $dbConnection->prepare("$sql");
$stmt->bindParam(':st1', $searchterm);
$stmt->bindParam(':st2', $searchterm);
$stmt->bindParam(':st3', $searchterm);
$stmt->execute();

$dbConnection = null;

foreach ($stmt as $row)
	{
	if ($row['status']!="x")
	{
	echo "<tr>";
	if ($row['status']=="b")
		{
		echo "<td><span class='search'>" . ucfirst($row['name']) . "</span><br><span class='broken'>This information is possibly not up to date - use with caution.</span></td>";
		}
	else
		{
		echo "<td class='search'>" . ucfirst($row['name']) . "</td>";
		}
	if ($row['phone'] == NULL OR $row['phone']=="NULL") {
		$row['phone'] = "";
	}
	echo "<td>" . $row['phone'] . "</td>";
	if ($row['details'] == NULL OR $row['details']=="NULL") {
		$row['details'] = "";
	}
	echo "<td>" . ucfirst($row['details']) . "</td>";
	echo "</tr>";
	}
	}
echo "</table></div>";

echo "</div>


</body>

</html>";

	}

?>