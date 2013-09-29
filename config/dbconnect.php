<?php

include 'dbconfig.php';

// Connect to database
$con = @mysql_connect("localhost:3306",$dbuser,$dbpasswd,FALSE,MYSQL_CLIENT_INTERACTIVE);
if (!$con)
	{
	echo "<div id='errormsg'>
Sorry - our server is temporarily unavailable.
<br />
<br />
Please <a class='inlinelink' href='" . $page . "' target='_self'>re-load the page</a> in a few seconds and it should work fine.
<br />
<br />
<p class='smallerrormsg'>Please <a class='inlinelink' href='contactus.html' target='_self'>let us know</a> if this message appears frequently (it means we need to get a bigger server!). Thank-you.</p>
</div>

<div id='spacer'>
</div>

<div id='bottombar'>
<a href='contactus.html' target='_self'>Contact us</a>
<a href='reportfault.html' target='_self'>Report fault</a>
<a href='aboutus.html' target='_self'>About us</a>
<span>&#169; 2012 itamus.com</span>
</div>

</div>

</body>
</html>";

// Counter of how many times there is failure to connect to database (stored in counter.txt file)
	$countfile = fopen("config/counter.txt","r");
	$errcount = fread($countfile,"10");
	fclose($countfile);

	$errcount ++;

	$countfile = fopen("config/counter.txt","w");
	fwrite($countfile,$errcount);
	fclose($countfile);

	die("");
  }

mysql_query("SET interactive_timeout=10");
  
mysql_select_db("itamuslinks", $con);

?>