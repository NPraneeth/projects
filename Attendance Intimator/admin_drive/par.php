<html>
<?php
session_start();
include('db.php');
if(!$_SESSION['adminu'])
{
echo "<meta http-equiv='refresh' content='0;url=index.php' >";
}
?>

<head>
<link rel="stylesheet" type="text/css" href="css/login.css"/>
<style>

#sub{
display:block;
background:#5F9EA0;
padding:10px 30px;

color:white;
font-size:1em;
font-family:calibri;
float:right;
}
#sub:hover
{
cursor:pointer;
}


input[type="text"],input[type="date"],select[type="input"],input[type="password"],textarea[type="input"],input[type="date"]
{

width:100%;
padding:10px;
border-radius:5px;
background:transparent;
border:1px solid pink;
}
#box_log
{
	padding:30px;
border:1px solid black;
position:absolute;
top:25%;
left:30%;
width:400px;
background:#FFF0F5;
}
</style>

</head>
<body style="background-image:url('clg.jpg');background-size:cover;background-repeat:no-repeat;background-attachment:fixed;">
<div style="display:block;height:105%;width:100%;background:#303030;background:rgba(0,0,0,.8);margin:0;background-repeat:repeat;"></div>
<ul id="mm" style="width:1200px;">
<li id=""style=""><a href="admin_in.php" style="color:white">Attendance Report</a></li>
<li id=""style=""><a href="admin_in.php" style="color:white">Counselling report</a></li>
<li id=""style=""><a href="par.php" style="color:white">Parent Login</a></li>

</ul>

	<div id="box_log">
	
	<form action="va.php" name="st"method="POST"><br>
	<span style="font-family:calibri;font-size:1em;">Add New Login status</span>
<input type="text" name="roll" placeholder="Roll No."required><br><br>
<input type="text" name="keyy" placeholder="Key . Ex:278fjj47"required><br><br></center>
<center><input type="submit" id="sub"name="st"value="Add Parent"></center>
<br>
</form>
<form action="va.php" name="me"method="POST"><br>
	<span style="font-family:calibri;font-size:1em;">Add Complaint</span>
<input type="text" name="rolln"  placeholder="Roll No."required><br><br>

<textarea type="input" name="comp"  placeholder="Complaint."required></textarea><br><br>
<input type="date" name="date"  required><br><br></center>
<center><input type="submit" id="sub"name="me"value="Add Complaint"></center>
<br>
</form>
	
	</div>
<a href="logout.php"style="display:block;background:#303030;position:absolute;top:10%;right:5%;color:white;text-decoration:none;padding:15px;">Logout</a>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
	$("#prof").click(function(){
	$("#atten").show();
	$("#counc").hide();
	});
	
	
	$("#dri").click(function(){
	$("#drives").show();
	$("#profiles").hide();
	
	$("#atten").hide();
	$("#counc").hide();
	});
	$("#att").click(function(){
	$("#atten").show();
	$("#profiles").hide();
	$("#drives").hide();
	
	$("#counc").hide();
	});
	$("#councel").click(function(){
	$("#counc").show();
	$("#profiles").hide();
	$("#drives").hide();
	$("#atten").hide();
	});
	});
	</script>

</body>
</html>