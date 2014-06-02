<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">

<html	xmlns="http://www.w3.org/1999/xhtml"
		xml:lang="en" lang="en"
	xmlns:fb="http://ogp.me/ns/fb#">


<head prefix="og: http://ogp.me/ns# itamuscom: 
                  http://ogp.me/ns/apps/itamuscom#">

<title>itamus.com QoF PHQ9 HAD CHADS2 6CIT GPCOG QRISK NICE SIGN IPSS FRAX</title>

<meta name="description" content="All the links that a busy healthcare professional will ever need. QoF PHQ9 HAD CHADS2 6CIT GPCOG QRISK NICE SIGN IPSS FRAX" />

<link rel="stylesheet" type="text/css" href="config/stylesheet4.css" /> 

<base target="_blank" />

<!-- Facebook opengraph attributes -->

<meta property="og:title" content="itamus.com"/>
<meta property="og:type" content="website"/>
<meta property="og:url" content="http://www.itamus.com/"/>
<meta property="og:image" content="http://www.itamus.com/config/itamuslogo.jpg"/>
<meta property="og:site_name" content="itamus.com"/>
<meta property="og:description" content="All the links that a busy healthcare professional will ever need."/>
<meta property="fb:app_id" content="315414941853594"/>


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


<!-- Load the Facebook software -->

<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '315414941853594', // App ID
      channelUrl : '//http://www.itamus.com/config/channel.html', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Additional initialization code here
  };

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
</script>


<!-- Facebook like and send button code -->

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<div id="container">

<div id="header">
<h1>itamus.com</h1>
</div>

<?php

$page = "index.php";

include 'config/dbconnect.php';

// set $numlinks to be the number of rows (links) in the database
$nl = mysql_query("SELECT COUNT(*) AS linkcount FROM links_db");
$numlinks = mysql_fetch_array($nl);

//mysql_close($con);

echo "<div id='headerright'><div id='headercount'><span>" . $numlinks['linkcount'] . "</span> links and growing</div>
<form method='get' action='search.php' target='_self'>
<input type='text' name='search' size='20' />
<input type='submit' value='Search' />
</form>
</div>";

// set $doty to be the day of the year
$doty = idate("z");

// set $lotd to be the modulus (left over) when day of the year is divided by the number of links
$lotd = fmod($doty,$numlinks['linkcount']);
$lotd_adminium = (($lotd-1)*10)+1; // this corrects for adminiums id's incrementing by 10 each time, rather than by 1

// get the row from the links database with a id number equal to $lotd. If this is blank then add 1 to $lotd and try again until it contains something

do
{
$query = "SELECT link_name,link_destination,description,link_type,status FROM links_db WHERE id=" . $lotd_adminium;
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$lotd++;
$lotd_adminium = $lotd_adminium + 10;
}
while ($row['link_name']=="" OR $row['status']!="");

mysql_close($con);

if ($row['link_type']=="clinical_info")
	{
	$bgc = "#FFE6E6";
	$fc = "#CC0000";
	}
elseif ($row['link_type']=="scoring_systems")
	{
	$bgc = "#E6FAE6";
	$fc = "#008C00";
	}
elseif ($row['link_type']=="contracts_regs")
	{
	$bgc = "#FFFFBF";
	$fc = "#8C8C00";
	}
elseif ($row['link_type']=="for_patients")
	{
	$bgc = "#E6E6FF";
	$fc = "#0000FF";
	}
else
	{
	$bgc = "#F0E8D9";
	$fc = "#543800";
	}

echo "<div id='lotdtab'>
<table style='background-color:" . $bgc . ";'>";
	
  echo "<tr>";
  echo "<td class='lotd'>Link of the day</td>";
  echo "<td><a style='color:" . $fc . ";' href='" . $row['link_destination'] . "' onClick=\"_gaq.push(['_trackEvent', '" . $row['link_type'] . "', '" . $row['link_name'] . "', 'lotd']);\">" . $row['link_name'] . "</a></td>";
  echo "<td>" . $row['description'] . "</td>";
  echo "</tr>";

echo "</table></div>";

?>

<!--
<div id='msfad'>
<table>
	<tr>
		<td class="msflink"><a href="/msf/index.php" target="_self" onClick="_gaq.push(['_trackEvent', 'msf', 'index.php']);">New FREE online multi-source feedback tool
		<br />
		Using the GMC MSF questionnaire - perfect for your appraisal
		<br/>
		Click here to find out more and access for FREE </a>
		</td>
	</tr>
</table>
</div>
-->

<div id="block1">
<div class="title">
<h2><a href="clininfo.php?topic=na" target="_self">Clinical Information</a></h2>
</div>

<div class="examples">
<a href="http://guidance.nice.org.uk/" onClick="_gaq.push(['_trackEvent', 'clinical_info', 'NICE guidelines', 'frontpage']);">NICE guidelines</a><br />
<div class="spacer5"></div>
<a href="http://www.gpnotebook.co.uk/" onClick="_gaq.push(['_trackEvent', 'clinical_info', 'GPnotebook', 'frontpage']);">GP Notebook</a><br />
<div class="spacer5"></div>
<a href="http://www.mapofmedicine.com/" onClick="_gaq.push(['_trackEvent', 'clinical_info', 'Map of Medicine', 'frontpage']);">Map of Medicine</a><br />
<div class="spacer5"></div>
<a href="http://bnf.org/bnf/" onClick="_gaq.push(['_trackEvent', 'clinical_info', 'BNF', 'frontpage']);">BNF</a><br />
</div>

<div class="more">
<a href="clininfo.php?topic=na" target="_self">more<span class="arrow1">></span><span class="arrow2">></span></a>
</div>

</div>


<div id="block2">
<div class="title">
<h2><a href="scoring.php?topic=na" target="_self">Scoring Systems & Tools</a></h2>
</div>

<div class="examples">
<a href="http://www.psycho-oncology.info/PHQ9_depression.pdf" onClick="_gaq.push(['_trackEvent', 'scoring_systems', 'PHQ9', 'frontpage']);">PHQ9</a><br />
<div class="spacer5"></div>
<a href="http://www.who.int/growthref/cht_bmifa_boys_perc_5_19years.pdf" onClick="_gaq.push(['_trackEvent', 'scoring_systems', 'BMI chart for boys', 'frontpage']);">Boys' BMI chart /</a><br />
<a href="http://www.who.int/growthref/cht_bmifa_girls_perc_5_19years.pdf " onClick="_gaq.push(['_trackEvent', 'scoring_systems', 'BMI chart for girls', 'frontpage']);">Girls' BMI chart</a><br />
<div class="spacer5"></div>
<a href="http://www.britishsnoring.co.uk/sleep_apnoea/epworth_sleepiness_scale.php" onClick="_gaq.push(['_trackEvent', 'scoring_systems', 'Epworth (online)', 'frontpage']);">Epworth score /</a><br />
<a href="http://barrythompsonmd.com/wp-content/uploads/2009/10/Epworth-Sleepiness-Scale.pdf" onClick="_gaq.push(['_trackEvent', 'scoring_systems', 'Epworth (pdf)', 'frontpage']);">as pdf</a><br />
<div class="spacer5"></div>
<a href="http://www.eyetestnow.com/images/snellen_block_letter_eye_chart_eye_exam_test.pdf" onClick="_gaq.push(['_trackEvent', 'scoring_systems', 'Snellen chart', 'frontpage']);">Snellen chart</a><br />
</div>

<div class="more">
<a href="scoring.php?topic=na" target="_self">more<span class="arrow1">></span><span class="arrow2">></span></a>
</div>

</div>


<div id="block3">
<div class="title">
<h2><a href="conregs.php" target="_self">Contracts & Regulations</a></h2>
</div>

<div class="examples">
<a href="http://www.nhsemployers.org/~/media/Employers/Documents/PCC/QOF/2014-15%20General%20Medical%20Services%20contract%20-%20%20Quality%20and%20Outcomes%20Framework%20-%20Guidannce%20for%20GMS%20contract%202014-15.pdf" onClick="_gaq.push(['_trackEvent', 'contracts_regs', 'QoF 2014/15', 'frontpage']);">QoF for 2014/15 /</a><br />
<a href="http://www.nhsemployers.org/~/media/Employers/Documents/Primary%20care%20contracts/QOF/2014-15/Summary%20of%20changes%20to%20QOF%202014-15%20-%20England%20only.pdf" onClick="_gaq.push(['_trackEvent', 'contracts_regs', 'QoF 2014/15 summary of changes', 'frontpage']);">summary</a><br />
<div class="spacer5"></div>
<a href="http://www.pcc-cic.org.uk/article/qof-business-rules-v27" onClick="_gaq.push(['_trackEvent', 'contracts_regs', 'QoF business rules v27', 'frontpage']);">QoF business rules</a><br />
<div class="spacer5"></div>
<a href="http://www.hpa.org.uk/Topics/InfectiousDiseases/InfectionsAZ/NotificationsOfInfectiousDiseases/ListOfNotifiableDiseases/" onClick="_gaq.push(['_trackEvent', 'contracts_regs', 'Notifiable diseases', 'frontpage']);">Notifiable diseases</a><br />
<div class="spacer5"></div>
<a href="http://www.dft.gov.uk/dvla/medical/~/media/pdf/medical/at_a_glance.ashx" onClick="_gaq.push(['_trackEvent', 'contracts_regs', 'DVLA fitness to drive rules (pdf download)', 'frontpage']);">DVLA fitness to drive rules</a><br />
</div>

<div class="more">
<a href="conregs.php" target="_self">more<span class="arrow1">></span><span class="arrow2">></span></a>
</div>

</div>

<div id="block4">
<div class="title">
<h2><a href="forpatients.php?topic=na" target="_self">For Patients</a></h2>
</div>

<div class="examples">
<a href="http://www.patient.co.uk/" onClick="_gaq.push(['_trackEvent', 'for_patients', 'Patient.co.uk', 'frontpage']);">Patient.co.uk</a><br />
<div class="spacer5"></div>
<a href="http://www.moodgym.anu.edu.au/" onClick="_gaq.push(['_trackEvent', 'for_patients', 'MoodGYM', 'frontpage']);">Mood gym</a><br />
<div class="spacer5"></div>
<a href="http://www.npc.nhs.uk/patient_decision_aids/pda.php#BNF" onClick="_gaq.push(['_trackEvent', 'for_patients', 'Patient Decision Aids', 'frontpage']);">Patient decision aids</a><br />
<div class="spacer5"></div>
<a href="http://www.fpa.org.uk/helpandadvice/contraception" onClick="_gaq.push(['_trackEvent', 'for_patients', 'Contraceptive options', 'frontpage']);">Contraceptive options</a><br />
</div>

<div class="more">
<a href="forpatients.php?topic=na" target="_self">more<span class="arrow1">></span><span class="arrow2">></span></a>
</div>

</div>


<div id="block5">
<div class="title">
<h2><a href="cpd.php" target="_self">CPD</a></h2>
</div>

<div class="examples">
<a href="https://www.gptools.org/" onClick="_gaq.push(['_trackEvent', 'cpd', 'GP Tools', 'frontpage']);">GP tools</a><br />
<div class="spacer5"></div>
<a href="https://appraisals.clarity.co.uk/" onClick="_gaq.push(['_trackEvent', 'cpd', 'Appraisal toolkit', 'frontpage']);">Appraisal toolkit (Clarity Informatics)</a><br />
<div class="spacer5"></div>
<a href="http://www.rcgp.org.uk/" onClick="_gaq.push(['_trackEvent', 'cpd', 'RCGP', 'frontpage']);">RCGP</a><br />
<div class="spacer5"></div>
<a href="http://www.rcn.org.uk/" onClick="_gaq.push(['_trackEvent', 'cpd', 'RCN', 'frontpage']);">RCN</a><br />
</div>

<div class="more">
<a href="cpd.php" target="_self">more<span class="arrow1">></span><span class="arrow2">></span></a>
</div>

</div>


<div id="block6left">
<p class="info">Please send us any extra links you feel should be on this site.</p>
<form method="post" action="sendmail.php" name="ExtraLink" target="_self">
	<input type="hidden" name="subject" value="Extra Link" />
	<input type="hidden" name="good_url" value="extralinksent.php" />
	<input type="hidden" name="bad_url" value="emptysend.php" />
<input class="indent40" type="text" name="mesg" size="24" value="Enter site name or address" onclick="this.value='';" />
<input type="submit" value="Send">
</form>
</div>

<div id="block6right">
<!-- Facebook code to place the like and send buttons -->
<div class="fb-like" data-href="http://www.itamus.com" data-send="true" data-width="285" data-show-faces="false" data-font="verdana"></div>
</div>


<?php
include 'bottombar.php';
?>


</div>

</body>

</html>