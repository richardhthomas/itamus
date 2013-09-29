<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
"http://www.w3.org/TR/html4/frameset.dtd">
<html>


<head>

<title>Scoring Systems</title>

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

<div id="header2scoring">
<h3 class="scoring">Scoring Systems & Tools</h3>
</div>


<?php

$page = "scoring.php?topic=" . $_GET['topic'];

include 'config/dbconnect.php';

/* Build left menu.
$_GET retrieves the variable sent in the url.
'All' and 'General' categories are separate at the top of the menu so they don't appear in alphabeticla order (also 'All' is not a category within the database so wouldn't appear at all).
The loop then goes through each of the Categories defined in the database and lists them as a menu - if the Category from the database is found to be the same as the $_GET variable (which holds the selected topic) the style is changed to highlight that menu item.
*/
echo "<div id='leftmenuscoring'>
	<ul>
		<li><a ";
		if ($_GET['topic']=="All")
			echo "class='slctdscoring' ";
		echo "href='scoring.php?topic=All' target='_self'>All</a></li>";

$leftmenulist = mysql_query("SELECT DISTINCT category FROM links_db WHERE link_type LIKE '%scoring_systems%' ORDER BY category");

while($menuitem = mysql_fetch_array($leftmenulist))
	{
	if ($menuitem['category']!="General")
		{
		echo "<li><a ";
		if ($menuitem['category']==$_GET['topic'])
			echo "class='slctdscoring' ";
		echo "href='scoring.php?topic=" . $menuitem['category'] . "' target='_self'>" . $menuitem['category'] . "</a></li>";
		}
	}

echo "</ul></div>";
	
/*
Build the table
If the used has chosen 'All' then all records are chosen, otherwise the $_GET variable is used to define the query and just pick records assigned to that category.
*/
if ($_GET['topic']=="na")
	{
	echo "<div id='namsg'>
	<p>Please select a category from the menu</p>
	</div>";
	}
else
{
if ($_GET['topic']=="All")
	$query = "SELECT link_name,link_destination,description,status FROM links_db WHERE link_type LIKE '%scoring_systems%' ORDER BY link_name";
else
	$query = "SELECT link_name,link_destination,description,status FROM links_db WHERE link_type LIKE '%scoring_systems%' AND category='" . $_GET['topic'] . "' ORDER BY link_name";

$result = mysql_query($query);

mysql_close($con);

echo "<div id='clintab'>
<table>
<tr>
<th>Name</th>
<th>Description</th>
</tr>";

while($row = mysql_fetch_array($result))
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
		echo "<td><a class='scoring' href='" . $row['link_destination'] . "' onClick=\"_gaq.push(['_trackEvent', 'scoring_systems', '" . $row['link_name'] . "']);\">" . $row['link_name'] . "</a></td>";
		echo "<td>" . $row['description'] . "</td>";
		}
	echo "</tr>";
	}
  }
echo "</table></div>";
}

include 'bottombar.php';

?>


</div>


</body>

</html>