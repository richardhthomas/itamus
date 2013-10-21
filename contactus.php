<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
"http://www.w3.org/TR/html4/frameset.dtd">
<html>


<head>

<title>itamus.com</title>

<link rel="stylesheet" type="text/css" href="config/stylesheet4.css" /> 

<!-- Google analytics -->

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
<a id="homelink" href="index.php">Home</a>
</div>

<div id="header2search">
<h3 class="search">Contact us</h3>
</div>

<div id="bbpagemsg">
Use this form to contact us. We would particularly like to know if you've spotted a fault.
<br />
Please provide an e-mail address so we can get back to you. Thanks.
</div>

<div id="bbpageform">
<form method="post" action="sendmail.php" name="Contactus">
	<input type="hidden" name="subject" value="Contact us" />
	
<table>
<tr>
<td>Name:</td>
<td><input type="text" name="Fullname"/></td>
</tr>
<tr>
<td>Email address:</td>
<td><input type="text" name="Emailaddr"/></td>
</tr>
<tr>
<td>Message:</td>
<td><textarea name="mesg" rows="5" cols="70"></textarea>
<input type="submit" value="Send"></td>
</tr>
</table>
</form>
</div>

<?php
include 'bottombar.php';
?>


</div>


</body>

</html>
