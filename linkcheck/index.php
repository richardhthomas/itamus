
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">

 <head>

  <title>Itamus linkcheck</title>

 </head>

 <body>
 
  <ul id="test">

<?php

// Connect to database
include 'dbconnect.php';

$query = "SELECT id,link_name,link_destination,status FROM links_db";

$result = mysql_query($query);

while($row = mysql_fetch_array($result))
  {
  echo "<li><a href='" . $row['link_destination'] . "'>" . $row['status'] . " " . $row['id'] . " " . $row['link_name'] . "</a></li>";
  }

// check Derby section of site
$query = "SELECT id,name,link,status FROM derby";

$result = mysql_query($query);

mysql_close($con);

while($row = mysql_fetch_array($result))
  {
  if ($row['link']!=NULL)
	{
	echo "<li><a href='" . $row['link'] . "'>" . $row['status'] . " " . $row['id'] . " " . $row['name'] . "</a></li>";
	}
  }

?>

</ul>

 </body>

</html>