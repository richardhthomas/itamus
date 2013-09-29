<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
"http://www.w3.org/TR/html4/frameset.dtd">
<html>


<head>

<title>Contracts & Regulations</title>

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

<div id="header2conreg">
<h3 class="conreg">Contracts & Regulations</h3>
</div>

<div id="leftmenuconreg">
</div>


<?php

$page = "conregs.php";

include 'config/dbconnect.php';

/* Build left menu.
There isn't a left menu yet...
*/
	
/*
Build the table
If the used has chosen 'All' then all records are chosen, otherwise the $_GET variable is used to define the query and just pick records assigned to that category.
*/

$query = "SELECT link_name,link_destination,description,status FROM links_db WHERE link_type LIKE '%contracts_regs%' ORDER BY link_name";

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
		echo "<td><a class='conreg' href='" . $row['link_destination'] . "' onClick=\"_gaq.push(['_trackEvent', 'contracts_regs', '" . $row['link_name'] . "']);\">" . $row['link_name'] . "</a></td>";
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