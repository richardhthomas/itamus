<?php

session_start();

?>

<!DOCTYPE html>

<html>

<head>

<link rel="stylesheet" type="text/css" href="fbstylesheet.css" /> 

<script>
function validatepwd()
	{
	var pass1 = document.getElementById('pwd1').value;
	var pass2 = document.getElementById('pwd2').value;
	if (pass1 != pass2)
		{
		document.getElementById('chpwderr').innerHTML = 'Please re-enter your password - the two entries do not match';
		return false;
		}
	if (pass1.length > 15 || pass1.length < 6)
		{
		document.getElementById('chpwderr').innerHTML = 'Please choose a password between 6 and 15 characters in length';
		return false;
		}
	}
</script>

</head>


<body>

<div id="container">

<div id="header">
<h1>itamus.com</h1>
</div>

<div id="headerright">
<a id="homelink" href="logout.php">Log-out</a>
<br />
<a id="homelink" href="acchomepage.php">Back</a>
</div>

<div class="chpwd1">
<p>Please enter your new password. This should be between 6 and 15 characters long.</p>
<form name="changepwd" action="changepwdact.php" method="post" onsubmit="return validatepwd()">
<input id="pwd1" type='password' name='password1'>
<p>Please confirm</p>
<input id="pwd2" type='password' name='password2'>
<br /><br />
<input type='submit' value='Change'>
</form>
<p id="chpwderr"></p>
</div>

<?php
include 'bottombar.php';
?>

</div>

</body>
</html>