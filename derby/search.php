<!DOCTYPE html>

<html>

<head>

<title>itamus.com</title>

<link rel="stylesheet" type="text/css" href="stylesheet4.css" /> 

</head>


<body>

<div id="container">

<div id="header">
<h1>itamus.com</h1>
</div>

<div id="headerright">
<a id="homelink" href="index.php" target="_self">Home</a>
<form method="get" action="search.php" target="_self">
<input type="text" name="search" size="20" />
<input type="submit" value="Search" />
</form>
</div>

<div id="header2search">
<h3 class="search">Derby - Search results</h3>
</div>

<div id="leftmenusearch">
</div>

<?php

$page = "search.php?search=" . $_GET['search'];

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

$sql = "SELECT name,link,phone,details,status FROM derby WHERE name LIKE :st1 OR details LIKE :st2 OR search LIKE :st3 ORDER BY name";

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
		if ($row['link']!=NULL)
			{
			echo "<td><a class='search' href='" . $row['link'] . "' target='_blank'>" . ucfirst($row['name']) . "</a></td>";
			}
		else
			{
			echo "<td class='search'>" . ucfirst($row['name']) . "</td>";
			}
		}
	echo "<td>" . $row['phone'] . "</td>";
	echo "<td>" . ucfirst($row['details']) . "</td>";
	echo "</tr>";
	}
	}
echo "</table></div>";

?>


</div>


</body>

</html>