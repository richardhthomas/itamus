
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

$query = "SELECT link_id,link_name,link_destination,status FROM links_db";

$result = mysql_query($query);

mysql_close($con);

while($row = mysql_fetch_array($result))
  {
  echo "<li><a href='" . $row['link_destination'] . "'>" . $row['status'] . " " . $row['link_id'] . " " . $row['link_name'] . "</a></li>";
  }


// check Derby section of site

$dbuser = "locum";
$dbpasswd = "Trundl37";

// Connect to database
$con = @mysql_connect("localhost:3306",$dbuser,$dbpasswd,FALSE,MYSQL_CLIENT_INTERACTIVE);
if (!$con)
	{
	die("");
	}
  
mysql_select_db("locum", $con);

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