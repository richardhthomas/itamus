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
<a id="homelink" href="index.php">Home</a>
<form method="get" action="search.php">
<input type="text" name="search" size="20" />
<input type="submit" value="Search" />
</form>
</div>

<div id="header2search">
<h3 class="search">Derby</h3>
</div>

<div id="leftmenusearch">
<ul>
	<li><a href="../index.php">National itamus site</a></li>
	<li>Surgery info:
	<form method="POST" action="surgery.php">
	Password <input type="password" name="pass"></input>
	<input type="submit" name="Submit"></input>
	</form></li>
</ul>

</div>

<?php

$page = "index.php";

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

$sql = "SELECT name,link,phone,details,status FROM derby ORDER BY name";

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
		if ($row['link']!=NULL AND $row['link']!="" AND $row['link']!="NULL")
			{
			echo "<td><a class='search' href='" . $row['link'] . "' target='_blank'>" . $row['name'] . "</a></td>";
			}
		else
			{
			echo "<td class='search'>" . ucfirst($row['name']) . "</td>";
			}
		}
	if ($row['phone'] == NULL) {
		$row['phone'] = "";
	}
	echo "<td>" . $row['phone'] . "</td>";
	if ($row['details'] == NULL) {
		$row['details'] = "";
	}
	echo "<td>" . ucfirst($row['details']) . "</td>";
	echo "</tr>";
	}
	}
echo "</table></div>";

?>


</div>


</body>

</html>