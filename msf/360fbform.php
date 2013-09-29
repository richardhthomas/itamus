<!DOCTYPE html>

<html>

<head>

<link rel="stylesheet" type="text/css" href="fbstylesheet.css" /> 

<script>
// Define new object called q26Obj - no properties or methods are defined for it.
var q26Obj = new Object();
var q23Obj = new Object();

function othq23()
	{
	document.getElementById("q23oth").innerHTML="<input type='radio' name='q23' value='ot' checked='checked' onclick='othq23.apply(q23Obj);' /><span class='space10'></span><input type='text' name='q23b' value='Please specify' onclick='this.value=\"\";' onkeyup='limit(this,25)' onblur='limit(this,25)'/>";
	tidyq23.apply(q23Obj, ['q23oth']);
	}

function drq23()
	{
	document.getElementById("q23dr").innerHTML="<input type='radio' name='q23' value='dr' checked='checked' onclick='drq23.apply(q23Obj);' />Doctor - Select this box if you are in a training grade<input type='checkbox' name='q23a' value='y' />";
	tidyq23.apply(q23Obj, ['q23dr']);
	}

function tidyq23(id)
	{
	if (id!='q23dr')
		{
		document.getElementById("q23dr").innerHTML="<input type='radio' name='q23' value='dr' onclick='drq23.apply(q23Obj);' />Doctor";
		}
	if (id!='q23oth')
		{
		document.getElementById("q23oth").innerHTML="<input type='radio' name='q23' value='ot' onclick='othq23.apply(q23Obj);'/>Other";
		}
	}
	
function othq26(id,val)
	{
	elem = document.getElementById(id);
	elem.innerHTML="<input type='radio' name='q26' value='" + val +"' checked='checked' onclick=\"othq26.apply(q26Obj, ['" + id + "', '" + val + "']);\" /><span class='space10'></span><input type='text' name='q26a' size='12' value='Please specify' onclick='this.value=\"\";' onkeyup='limit(this,20)' onblur='limit(this,20)'/>";
	tidyq26.apply(q26Obj, [id]);
	}

function tidyq26(id)
	{
	var othcont = new Array(5);
	for (var i=0; i<5; i++)
		{
		arrid = 'q26oth' + i;
		othcont[i] = [arrid,' ',' '];
		}
	othcont[0][1] = 'ow'; othcont[0][2] = 'Any other White background';
	othcont[1][1] = 'om'; othcont[1][2] = 'Any other Mixed background';
	othcont[2][1] = 'oa'; othcont[2][2] = 'Any other Asian background';
	othcont[3][1] = 'ob'; othcont[3][2] = 'Any other Black background';
	othcont[4][1] = 'oo'; othcont[4][2] = 'Any other';

	// maybe also define this array on page loading (i.e. outside a function) so doesn't need to be done every time a button is clicked.

	for (var i=0; i<5; i++)
		{
		if (othcont[i][0]!=id)
			{
			elem = document.getElementById(othcont[i][0]);
			elem.innerHTML="<input type='radio' name='q26' value='" + othcont[i][1] + "' onclick=\"othq26.apply(q26Obj, ['" + othcont[i][0] + "', '" + othcont[i][1] + "']);\" />" + othcont[i][2];
			}
		}
	}

function validateForm()
	{
	var radios = document.getElementsByTagName('input');
	var radionamechk=0;
	var buttoncount=0;
	var numbuttons=new Array();
	var qno=1;
	numbuttons[qno]=0;
	var prevname='q1'; // set this to the name of the first radiobutton
	
	var content="";
	
	// This bit works out how many buttons each question has so the routine below can be automated to a greater degree (the limit to which namecount has to reach before triggering an alert can be different for each question).
	for (var i = 0; i < radios.length; i++)
		{
		if (radios[i].type === 'radio')
			{
			if (radios[i].name == prevname)
				{
				numbuttons[qno]++;
				}
			else
				{
				qno++;
				numbuttons[qno] = 1;
				prevname = radios[i].name;
				}
			}
		}
	
	// This bit goes through each radio button, sets radionamechk to 1 if the button is checked, and if it gets beyond the number of buttons for a question (buttoncount), provides an alert.
	qno = 1;
	for (var i = 0; i < radios.length; i++)
		{
		if (radios[i].type === 'radio')
			{
			if (radios[i].checked)
				{
				radionamechk = 1;
				}
			buttoncount++;
			if (buttoncount >= numbuttons[qno])
				{
				if (radionamechk != 1)
					{
					qnorep = qno;
					if (qnorep > 19)
						{
						qnorep++;
						}
					if (content == "")
						{
						content = "Please provide an answer for question(s) number " + qnorep;
						}
					else
						{
						content = content + ", " + qnorep;
						}
					}
				radionamechk = 0;
				buttoncount = 0;	
				qno++;
				}		
			}
		}
	
	if (content != "")
		{
		document.getElementById("report").innerHTML=content;
		return false;
		}
	disablesubmit();
	}

function disablesubmit()
	{
	document.getElementById("submitbutton").innerHTML="<input type='submit' value='Submit form' disabled='disabled' style='color:#C1C1C1'/>";
	}
	
function limit(obj,len)
	{
	while(obj.value.length>len)
		{
		obj.value=obj.value.replace(/.$/,'');//removes the last character
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
</div>

<table class="tab1">
<tr>
<td class="instr2" style='width:100%'>
Licensed doctors are expected to seek feedback from colleagues and patients and review and act upon that feedback where appropriate.
<br /><br />
The purpose of this exercise is to provide doctors with information about their work through the eyes of those they work with and is intended to help inform their further development.
<br /><br />
Your feedback is anonymous and NOT traceable to you. The personal questions at the end are compiled to give general statistics about respondents and are NOT associated with the rest of the questionnaire.
<br /><br />
Please answer all the questions. If you feel you cannot answer any question, please select ‘Don’t know’.
</td>
</tr>
</table>

<br />

<form name="360fbform" action="360fbprocess.php" method="post" onsubmit="return validateForm()">
<p class="instr1">Please rate your colleague in each of the following areas by selecting one button on each line.</p>
<table class="tab1">
	<tr>
		<th class="questno"></th>
		<th class="quest"></th>
		<th>Poor</th>
		<th>Less than satisfactory</th>
		<th>Satisfactory</th>
		<th>Good</th>
		<th>Very good</th>
		<th class="fill"></th>
		<th>Don't know</th>
	</tr>

<?php

$q = array(	"1"=>"Clinical knowledge",
			"2"=>"Diagnosis",
			"3"=>"Clinical decision making",
			"4"=>"Treatment (including practical procedures)",
			"5"=>"Prescribing",
			"6"=>"Medical record keeping",
			"7"=>"Recognising and working within limitations",
			"8"=>"Keeping knowledge and skills up to date",
			"9"=>"Reviewing and reflecting on own performance",
			"10"=>"Teaching (students, trainees, others)",
			"11"=>"Supervising colleagues",
			"12"=>"Commitment to wellbeing and care of patients",
			"13"=>"Communication with patients and relatives",
			"14"=>"Working effectively with colleagues",
			"15"=>"Effective time management",
			"16"=>"This doctor respects patient confidentiality",
			"17"=>"This doctor is honest and trustworthy",
			"18"=>"This doctor's performance is not impaired by ill health");


for ($x=1; $x<=15; $x++)
	{
	echo "<tr>
		<td class='questno'>$x</td>
		<td class='quest'>$q[$x]</td>
		<td><input type='radio' name='q" . $x . "' value='p' /></td>
		<td><input type='radio' name='q" . $x . "' value='ls' /></td>
		<td><input type='radio' name='q" . $x . "' value='s' /></td>
		<td><input type='radio' name='q" . $x . "' value='g' /></td>
		<td><input type='radio' name='q" . $x . "' value='vg' /></td>
		<td class='fill'></td>
		<td><input type='radio' name='q" . $x . "' value='dk' /></td>
	</tr>";
	}
	
?>

</table>

<br />

<p class="instr1">Please decide how far you agree with the following statements by selecting one button on each line.</p>

<table class="tab1">
	<tr>
		<th class="questno"></th>
		<th class="quest"></th>
		<th>Strongly disagree</th>
		<th>Disagree</th>
		<th>Neutral</th>
		<th>Agree</th>
		<th>Strongly agree</th>
		<th class="fill"></th>
		<th>Don't know</th>
	</tr>

<?php
for ($x=16; $x<=18; $x++)
	{
	echo "<tr>
		<td class='questno'>$x</td>
		<td class='quest'>$q[$x]</td>
		<td><input type='radio' name='q" . $x . "' value='sd' /></td>
		<td><input type='radio' name='q" . $x . "' value='di' /></td>
		<td><input type='radio' name='q" . $x . "' value='n' /></td>
		<td><input type='radio' name='q" . $x . "' value='a' /></td>
		<td><input type='radio' name='q" . $x . "' value='sa' /></td>
		<td class='fill'></td>
		<td><input type='radio' name='q" . $x . "' value='dk' /></td>
	</tr>";
	}
echo "</table>";
?>

<br /><br />

<table class='tab1'>
	<tr>
		<td class='questno'>19</td>
		<td class='quest'>This doctor is fit to practise medicine</td>
		<td><input type='radio' name='q19' value='y' />Yes</td>
		<td></td>
		<td><input type='radio' name='q19' value='n' />No</td>
		<td></td>
		<td><input type='radio' name='q19' value='dk' />Don't know</td>
		<td></td>
	</tr>
</table>

<br />

<table class="holtable">
	<tr>
		<td class='questno'>20</td>
		<td class='instr1'>Please add any other comments you want to make about this doctor. <span class='instr2'>Please note: No one will be identified when this information is given back to the doctor.</span></td>
	</tr>
	<tr>
		<td class='questno'></td>
		<td><textarea rows='6' cols='102' name='q20' onkeyup="limit(this,612)" onblur="limit(this,612)"></textarea></td>
	</tr>
</table>

	
<br />
<p class="instr1">The next questions will give us some basic information about who took part in the survey. This will NOT be linked to your answers above.</p>
<table class='holtable'>
<tr>
<td class='questno'>21</td>
<td class='demq1'>Are you:</td>
<td><input type='radio' name='q21' value='f' />Female</td>
<td><input type='radio' name='q21' value='m' />Male</td>
<td></td>
<td></td>
</tr>
</table>

<table class='holtable'>
<tr>
<td class='questno'>22</td>
<td class='demq1'>Age:</td>
<td><input type='radio' name='q22' value='16' />16 to 19</td>
<td><input type='radio' name='q22' value='20' />20 to 29</td>
<td><input type='radio' name='q22' value='30' />30 to 39</td>
<td><input type='radio' name='q22' value='40' />40 to 49</td>
<td><input type='radio' name='q22' value='50' />50 to 59</td>
<td><input type='radio' name='q22' value='60' />60 or over</td>
</tr>
</table>

<table class='holtable'>
	<tr>
		<td class='questno'>23</td>
		<td class='demq2' style='width:96.4%' colspan='3'>Your professional role:</td>
	</tr>
	<tr>
		<td class='questno'></td>
		<td id='q23dr' class='holtd3' style='width:96.4%' colspan='3'><input type='radio' name='q23' value='dr' onclick='drq23.apply(q23Obj);' />Doctor</td>
	</tr>
	<tr>
		<td class='questno'></td>
		<td class='holtd3'><input type='radio' name='q23' value='rn' onclick="tidyq23.apply(q23Obj, ['']);"/>Registered Nurse</td>
		<td class='holtd3'><input type='radio' name='q23' value='hv' onclick="tidyq23.apply(q23Obj, ['']);"/>Health Visitor / Midwife</td>
		<td class='holtd3'><input type='radio' name='q23' value='ph' onclick="tidyq23.apply(q23Obj, ['']);"/>Pharmacist</td>
	</tr>
	<tr>
		<td class='questno'></td>
		<td class='holtd3'><input type='radio' name='q23' value='ad' onclick="tidyq23.apply(q23Obj, ['']);"/>Administrator / Receptionist / Secretary</td>
		<td class='holtd3'><input type='radio' name='q23' value='ah' onclick="tidyq23.apply(q23Obj, ['']);"/>Allied Healthcare Professional</td>
		<td class='holtd3'><input type='radio' name='q23' value='hc' onclick="tidyq23.apply(q23Obj, ['']);"/>Health Care Assistant</td>
	</tr>
	<tr>
		<td class='questno'></td>
		<td class='holtd3'><input type='radio' name='q23' value='nm' onclick="tidyq23.apply(q23Obj, ['']);"/>Non-clinical Manager</td>
		<td id='q23oth' class='holtd3'><input type='radio' name='q23' value='ot' onclick='othq23.apply(q23Obj);'/>Other</td>
		<td></td>
	</tr>
</table>

<table class='holtable'>
	<tr>
		<td class='questno'>24</td>
		<td class='demq2' style='width:96.4%' colspan='3'>How recently have you been familiar with this doctor’s clinical practice?</td>
	</tr>
	<tr>
		<td class='questno'></td>
		<td class='holtd3'><input type='radio' name='q24' value='c' />Current colleague</td>
		<td class='holtd3'><input type='radio' name='q24' value='2' />Within the last 2 years</td>
		<td class='holtd3'><input type='radio' name='q24' value='5' />Between 2 and 5 years ago</td>
	</tr>
	<tr>
		<td class='questno'></td>
		<td class='holtd3'><input type='radio' name='q24' value='10' />Between 6 and 10 years ago</td>
		<td class='holtd3'><input type='radio' name='q24' value='++' />More than 10 years ago</td>
		<td class='holtd3'></td>
	</tr>
</table>

<table class='holtable'>
	<tr>
		<td class='questno'>25</td>
		<td class='demq2' style='width:96.4%' colspan='4'>During this period of your familiarity with this doctor’s clinical practice, how often did you have contact with the doctor?</td>
	</tr>
	<tr>
		<td class='questno'></td>
		<td><input type='radio' name='q25' value='md' />Most days</td>
		<td><input type='radio' name='q25' value='w' />Weekly</td>
		<td><input type='radio' name='q25' value='mo' />Monthly</td>
		<td><input type='radio' name='q25' value='lo' />Less often</td>
	</tr>
</table>

<table class='holtable'>
	<tr>
		<td class='questno'>26</td>
		<td class='demq2' style='width:96.4%' colspan='5'>What is your ethnic group? Please choose one section from A to E, and then click the appropriate button to indicate your cultural background.</td>
	</tr>
	<tr>
		<td class='questno'></td>
		<td class='demq2'><span class='space10'>A </span>White</td>
		<td class='demq2'><span class='space10'>B </span>Mixed</td>
		<td class='demq2'><span class='space10'>C </span>Asian or Asian British</td>
		<td class='demq2'><span class='space10'>D </span>Black or Black British</td>
		<td class='demq2'><span class='space10'>E </span>Chinese or other ethnic group</td>
	</tr>
	<tr>
		<td class='questno'></td>
		<td class='holtd5'><input type='radio' name='q26' value='wb' onclick="tidyq26.apply(q26Obj, ['']);"/>British</td>
		<td class='holtd5'><input type='radio' name='q26' value='mc' onclick="tidyq26.apply(q26Obj, ['']);"/>White and Black Caribbean</td>
		<td class='holtd5'><input type='radio' name='q26' value='ai' onclick="tidyq26.apply(q26Obj, ['']);"/>Indian</td>
		<td class='holtd5'><input type='radio' name='q26' value='bc' onclick="tidyq26.apply(q26Obj, ['']);"/>Caribbean</td>
		<td class='holtd5'><input type='radio' name='q26' value='ch' onclick="tidyq26.apply(q26Obj, ['']);"/>Chinese</td>
	</tr>
	<tr>
		<td class='questno'></td>
		<td class='holtd5'><input type='radio' name='q26' value='wi' onclick="tidyq26.apply(q26Obj, ['']);"/>Irish</td>
		<td class='holtd5'><input type='radio' name='q26' value='mb' onclick="tidyq26.apply(q26Obj, ['']);"/>White and Black African</td>
		<td class='holtd5'><input type='radio' name='q26' value='ap' onclick="tidyq26.apply(q26Obj, ['']);"/>Pakistani</td>
		<td class='holtd5'><input type='radio' name='q26' value='ba' onclick="tidyq26.apply(q26Obj, ['']);"/>African</td>
		<td id='q26oth4' class='holtd5'><input type='radio' name='q26' value='oo' onclick="othq26.apply(q26Obj, ['q26oth4', 'oo']);" />Any other</td>
		<!-- othq26 is the function name, apply is a method of the function object that calls a function and assigns it to an object (over-riding the default 'this'). So q26Obj is the name of the object to assign the function to and then in the square brackets an array of variables can be passed to the function.-->
	</tr>
	<tr>
		<td class='questno'></td>
		<td id='q26oth0' class='holtd5'><input type='radio' name='q26' value='ow' onclick="othq26.apply(q26Obj, ['q26oth0', 'ow']);" />Any other White background</td>
		<td class='holtd5'><input type='radio' name='q26' value='ma' onclick="tidyq26.apply(q26Obj, ['']);"/>White and Asian</td>
		<td class='holtd5'><input type='radio' name='q26' value='ab' onclick="tidyq26.apply(q26Obj, ['']);"/>Bangladeshi</td>
		<td id='q26oth3' class='holtd5'><input type='radio' name='q26' value='ob' onclick="othq26.apply(q26Obj, ['q26oth3', 'ob']);" />Any other Black background</td>
		<td class='holtd5'></td>
	</tr>
	<tr>
		<td class='questno'></td>
		<td class='holtd5'></td>
		<td id='q26oth1' class='holtd5'><input type='radio' name='q26' value='om' onclick="othq26.apply(q26Obj, ['q26oth1', 'om']);" />Any other Mixed background</td>
		<td id='q26oth2' class='holtd5'><input type='radio' name='q26' value='oa' onclick="othq26.apply(q26Obj, ['q26oth2', 'oa']);" />Any other Asian background</td>
		<td class='holtd5'></td>
		<td class='holtd5'></td>
	</tr>
</table>

<div id="submit">
<p id="report"></p>
<?php
$rc = $_GET['rc'];
echo "<input type='hidden' name='rc' value='$rc' />";
?>
<div id="submitbutton">
<input type="submit" value="Submit form"/>
</div>
</div>

</form>

</div>

</body>
</html>