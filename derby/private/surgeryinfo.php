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
<a id='homelink' href='index.php'>Home</a>
<form method='get' action='searchsurgery.php'>
<input type='text' name='search' size='20' />
<input type='submit' value='Search' />
</form>
</div>

<div id='header2search'>
<h3 class='search'>Local surgery info</h3>
</div>

<div id='leftmenusearch'>
<ul>
	<li><a href='../index.php'>National itamus site</a></li>
	<li><a href='index.php'>Derby info</a></li>
</ul>
</div>";

$page = "surgery.php";

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

$sql = "SELECT name,phone,details,status FROM osmaston ORDER BY name";

$stmt = $dbConnection->prepare("$sql");
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
	echo "<td>" . $row['phone'] . "</td>";
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