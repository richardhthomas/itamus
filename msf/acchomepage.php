<?php	

session_start();

// kick the user back to the index page if the usercode session variable is not set (which menas they have logged out then pressed back on their browser)
if (!isset($_SESSION['usercode']))
	{
	session_destroy();
	$head = "index.html";
	header("Location: $head");
	}

// transfer session variables into names which won't cause chaos with '" etc!
$usercode = $_SESSION['usercode'];
$firstname = $_SESSION['firstname'];
$surname = $_SESSION['surname'];	

// read how many pieces of feedback have been received so the download feedback button can be disabled if appropriate
// connect to database	
include 'dbconnect.php';

// read the number of respondents into $nor['COUNT(id)']
$sql = "SELECT COUNT(id) FROM msftable WHERE usercode=" . $usercode;
$result = mysql_query($sql);
$nor = mysql_fetch_array($result);

mysql_close($con);
?>

<!DOCTYPE html>

<html>

<head>

<link rel="stylesheet" type="text/css" href="fbstylesheet.css" /> 

</head>


<body>

<div id="container">

<div id="header">
<h1>itamus.com</h1>
</div>

<div id="headerright">
<a id="homelink" href="logout.php">Log-out</a>
</div>

<div class="acchp1">
<p>You will need to give each of your colleagues an invitation. This includes a code which they use to access the website and leave feedback.</p>
<p>Currently 25 invitations are provided and each can only be used once.</p>
<form name="rcspdf" action="rcspdf.php" method="post">
<?php
echo "<input type='hidden' name='usercode' value='$usercode' />
<input type='hidden' name='firstname' value='$firstname' />
<input type='hidden' name='surname' value='$surname' />";
?>
<input type="submit" value="Download Invitations" />
</form>
</div>

<div class="acchp1">
<h2>Number of responses received: 
<?php
echo $nor['COUNT(id)'];
?>
</h2>
<p>In order to preserve the anonymity of respondents, this button will not be functional until at least 3 people have left feedback. The feedback document can be dowloaded as many times as you wish - there is no need to necessarily wait until you believe all colleagues have responded.</p>
<form name="fbpdf" action="fbpdf.php" method="post">
<?php
echo "<input type='hidden' name='usercode' value='$usercode' />
<input type='hidden' name='firstname' value='$firstname' />
<input type='hidden' name='surname' value='$surname' />";

if ($nor['COUNT(id)'] < 3)
	{
	echo "<input type='submit' disabled='disabled' value='Download Feedback' />";
	}
else
	{
	echo "<input type='submit' value='Download Feedback' />";
	}
?>
</form>
</div>

<div class="acchp2">
<h2>Other tasks</h2>
<p><a href="changepwd.php">Change password</a></p>
</div>

<?php
include 'bottombar.php';
?>

</div>

</body>
</html>