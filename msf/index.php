<!DOCTYPE html>

<html>

<head>

<link rel="stylesheet" type="text/css" href="fbstylesheet.css" /> 

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
<a id="homelink" href="/index.php">Home</a>
</div>

<table class="respregtab2">
	<tr>
	<td class="respreg1">Welcome to our multi-source feedback tool</td>
	</tr>
</table>

<br />

<table class="respregtab2">
	<tr>
	<td class="respreg4">Use of our on-line GMC-based MSF tool is currently by invitation only. It will be openly available in due course.
	<br />
	For now, if you wish to use the MSF tool please <a href="/contactus.php" target="_self" onClick="_gaq.push(['_trackEvent', 'msf', 'sign up contact us']);">contact us</a> and we will get back to you with log-in details.</td>
	</tr>
</table>

<div class="respreglogin">
<form name="login" action="userval.php" method="post">
	<p class="respreg1">This way for those receiving feedback...</p>
	<p>Please log-in below to gather your feedback</p>
	<p>Username:<input type="text" name="username" size="20" /></p>
	<p>Password:<input type="password" name="password" size="20" /></p>
	<p><input type="submit" value="Log-in" /></p>
</form>
<p class="respreg4">Forgotten your log-in details? <a href="/contactus.php">Contact us</a> with your name and email and we'll get back to you.</p>
</div>

<div class="respreglogin">
<form name="respregform" action="respregprocess.php" method="post">
	<p class="respreg1">This way for those giving feedback...</p>
	<p>Thank-you for taking the time to provide ANONYMOUS feedback to your colleague</p>
	<p>Please enter your respondent code</p>
	<p><input type="text" name="respcode" size="12" /></p>
	<p><input type="submit" value="Next" /></p>
</form>
</div>

<?php
include 'bottombar.php';
?>

</div>

</body>
</html>