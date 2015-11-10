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


input[type="text"],input[type="date"],select[type="input"]
{

width:85%;
padding:20px;
border-radius:5px;
background:transparent;
border:1px solid pink;
}
#box_log
{
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
<li id="att"style="">Attendance Report</li>
<li id="councel"style="">Counselling report</li>
<li id=""style=""><a href="par.php" style="color:white">Parent Login</a></li>

</ul>

	
	
	
	<div id="box_log">

	
		<div id="atten">
		
<a href="weeklyat.php"style="display:block;background:#303030;position:absolute;top:14%;right:5%;color:white;text-decoration:none;padding:5px;">Date Range</a>
<div style="display:block;color:white;background:#5F9EA0;width:100%;padding:20px 0px;font-family:sans-serif;font-size:1.3em;text-align:center;">Attendance Report</div>
		
<br><br>	

		<form action="atreport.php" id="rl"method="get">

			<fieldset>
			<center>
				<select id="yy"type="input" name="year" required >
   <option>Choose year</option>
   <option>1</option>
   <option>2</option>
   <option>3</option>
   <option>4</option>
  
  
   </select>
   							
								<select id="yy"type="input" name="sem" required>
   <option>Choose Semester</option>
   <option>1</option>
   <option>2</option>

  
  
   </select>
   

   								<select id="branch"type="input" name="branch" STYLE="" required>
   <option>Choose branch</option>
   <option>CSE</option>
   <option>ECE</option>
   <option>EEE</option>
   <option>MECH</option>
   <option>CIVIL</option>
   <option>EIE</option>
   <option>IT</option>
  
  
   </select>
  
	
															<select id="section"type="input" name="section" STYLE="" required>
   <option>Section</option>
   <option>A</option>
   <option>B</option>
   <option>C</option>

  
  
   </select>
			
															<select id="period"type="input" name="period" STYLE="" required>
   <option>choose period</option>
   <option>1</option>
   <option>2</option>
   <option>3</option>
   <option>4</option>
   <option>5</option>
   <option>6</option>
   <option>7</option>
   <option>8</option>
  
  
   </select>
		
								
								<input type="date"  name="date" required></textarea>
						
							
							
							
							

			
</center>
				

				<p><input type="submit" id="sub"value="Generate"></p>

			</fieldset>

		</form>

		

	</div>
	<div id="counc">
<div style="display:block;color:white;background:#5F9EA0;width:100%;padding:20px 0px;font-family:sans-serif;font-size:1.3em;text-align:center;">Counselling Report</div>
		
<br><br>			

		<form action="gr.php" id="rl"method="get">

			<fieldset>
			<center>
<p><select type="input" name="fname">
<option>All</option>
<?php
include('db.php');
$f_list=mysql_query("select * from f_list");
while($fname=mysql_fetch_array($f_list))
{
$fn=$fname['uname'];
?>

<option><?php echo $fn; ?></option>

<?php } ?>
</select>
</p> 
				<p><input type="date" placeholder="Enter the date" name="date"></p>

				

				

				<p><input type="submit" id="sub" value="Generate"></p>
</center>
			</fieldset>

		</form>

		

	</div> <!-- end login -->
	
	
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