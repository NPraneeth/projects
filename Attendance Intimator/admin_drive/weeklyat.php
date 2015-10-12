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
top:15%;
left:30%;
width:400px;
background:#FFF0F5;
}
</style>

</head>
<body style="background-image:url('clg.jpg');background-size:cover;background-repeat:no-repeat;background-attachment:fixed;">
<div style="display:block;height:105%;width:100%;background:#303030;background:rgba(0,0,0,.8);margin:0;background-repeat:repeat;"></div>
<ul id="mm" style="width:1200px;">
<li id="att"style=""><a href="admin_in.php" style="color:white;">Attendance Report</a></li>
<li id="councel"><a href="admin_in.php" style="color:white;">Counselling report</a></li>

</ul>

	
	
	
	<div id="box_log">
	<div id="profiles">
<div style="display:block;color:WHITE;background:#5F9EA0;width:100%;padding:20px 0px;font-family:sans-serif;font-size:1.3em;text-align:center;">Check Profiles</div>
		
<br><br>
<center>
		<form action="" id="rl" style=""method="get">

<input type="text" required placeholder="Faculty Name"><br><br>
<input type="text" required placeholder="id"><br><br>

				

				<input type="submit" id="sub"value="submit">


		</form>

		</center>

	</div> <!-- end login -->
	<div id="drives">
<div style="display:block;color:white;background:#5F9EA0;width:100%;padding:20px 0px;font-family:sans-serif;font-size:1.3em;text-align:center;">On-Drive files</div>
		
<br><br>	

		<form action="" id="rl"method="get">

			<fieldset>
<center>
				<p><input type="text" required placeholder="Faculty Name"></p>

				<p><input type="text" required placeholder="ID"></p> 
</center>
				

				<p><input type="submit" id="sub"value="submit"></p>

			</fieldset>

		</form>

		

	</div> <!-- end login -->
		<div id="atten" style="">
		
<a href="admin_in.php"style="display:block;background:#303030;position:absolute;top:14%;right:5%;color:white;text-decoration:none;padding:5px;">Daily Report</a>
<div style="display:block;color:white;background:#5F9EA0;width:100%;padding:20px 0px;font-family:sans-serif;font-size:1.3em;text-align:center;">Attendance Report</div>
		
<br><br>	

		<form action="weekat.php" id="rl"method="get">

			<fieldset>
			<center>
				<select id="yy"type="input" name="year"  required >
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
		<br>
		<table><tr><th>
								<label>From:</label></th><th><label>To:</label></th></tr>
								<tr><td><input type="date"  name="fdate" required></textarea></td>
						
								<td><input type="date"  name="tdate" required></textarea></td></tr></table>
						
							
							
							
							

			
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
	
	$("#profiles").hide();
	$("#drives").hide();
	$("#atten").show();
	$("#counc").hide();
	
	
	
	
	});
	</script>

</body>
</html>