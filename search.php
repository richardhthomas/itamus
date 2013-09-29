<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
"http://www.w3.org/TR/html4/frameset.dtd">
<html>


<head>

<title>itamus.com</title>

<link rel="stylesheet" type="text/css" href="config/stylesheet4.css" /> 

<base target="_blank" />

<!-- Google Analytics -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-30724098-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

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
<h3 class="search">Search results</h3>
</div>

<div id="leftmenusearch">
</div>

<?php

$page = "search.php?search=" . $_GET['search'];

$date = date("d") . "/" . date("m") . "/" . date("y");
$srchwrite = "\r\n" . $date . "," . $_GET['search'];
$file = fopen("config/searchrecord.csv","a");
fwrite($file,$srchwrite);
fclose($file);

include 'config/dbconnectpdo.php';

/*
Build the table
*/

echo "<div id='clintab'>
<table>
<tr>
<th>Name</th>
<th>Description</th>
</tr>";

$sql = "SELECT link_name,link_destination,description,link_type,status FROM links_db WHERE link_name LIKE :st1 OR description LIKE :st2 OR category LIKE :st3 OR search_terms LIKE :st4";

$searchterm = "%" . $_GET['search'] . "%";

$stmt = $dbConnection->prepare("$sql");
$stmt->bindParam(':st1', $searchterm);
$stmt->bindParam(':st2', $searchterm);
$stmt->bindParam(':st3', $searchterm);
$stmt->bindParam(':st4', $searchterm);
$stmt->execute();

$dbConnection = null;

foreach ($stmt as $row)
  {
  if ($row['status']!="x")
	{
	echo "<tr>";
	if ($row['status']=="b")
		{
		echo "<td class='broken'>" . $row['link_name'] . "</td>";
		echo "<td>Sorry, host site is temporarily unavailable.</td>";
		}
	else
		{
		echo "<td><a class='search' href='" . $row['link_destination'] . "' onClick=\"_gaq.push(['_trackEvent', '" . $row['link_type'] . "', '" . $row['link_name'] . "']);\">" . $row['link_name'] . "</a></td>";
		echo "<td>" . $row['description'] . "</td>";
		}
  echo "</tr>";
	}
  }
echo "</table></div>";

include 'bottombar.php';

?>


</div>


</body>

</html>