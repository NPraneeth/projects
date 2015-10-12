<html>
<head>
<title>
Welcome | On'DriVe
</title>
<link rel="stylesheet" type="text/css" href="css/myform.css" />
 <link rel="stylesheet" type="text/css" href="wel.css">
 <link rel="stylesheet" type="text/css" href="pro.css">
  <link rel="stylesheet" type="text/css" href="wel.css">
 <link rel="stylesheet" type="text/css" href="pro.css">
 <link rel="stylesheet" type="text/css" href="drive.css">
 <link rel="stylesheet" type="text/css" href="css/c_report.css">
 <link rel="stylesheet" type="text/css" href="css/tabs.css">
</head>
<body style="background:url('hh.jpg');
background-size:cover;background-repeat:no-repeat;
">

 <span id="mylogo" style="">On'DriVe</span>

<!--<div style="display:block;position:absolute;top:30%;left:30%;padding:50px;background:#014965;color:white;font-size:3em;">Coming Soon ...</div>-->
<div id="menu">
<ul>
<li><a href="welcome.php">HOME</a></li>
<li><a href="profile.php">PROFILE</a></li>
<li><a href="mydrive.php">DRIVE</a></li>

<li><a href="mem.php">MEMBERS</a></li>
<li><a href="c_report.php">COUNSELLING REPORT</a></li>
<li><a href="acc.php">ACCOUNT</a></li>
<li><a href="logout.php">LOGOUT</a></li>
</ul>
</div>


<?php 
include('db.php');
session_start();
$name=$_SESSION['name'];
$chek=mysql_query("select * from details where uname='$name' ");
if(mysql_num_rows($chek)>0)
{

while($user=mysql_fetch_array($chek))
{
$uname=$user['name'];
$dob=$user['dob'];
$desig=$user['desig'];
$qualify=$user['qualify'];
$pursue=$user['pursue'];
$exp=$user['exp'];
$expe=$user['exp2'];
$doj=$user['doj'];
$pre=$user['present'];
$scale=$user['scale'];
$file=$user['propic'];

?>
<div style="float:right;position:absolute;top:0px;right:0px;height:160px;margin:0;padding:0;width:150px;
background:url('<?php  echo $file?>');background-size:cover;background-repeat:no-repeat;
"></div>
<div style="height:200px;width:180px;position:absolute;left:7%;top:30%;background:url('<?php echo $file?>');background-position:top left;background-size:cover;background-repeat:no-repeat;"> </div>
<div style="border:1px solid black;padding:50px;display:block;width:550px;margin-left:20%;">
       <table border="0" width="600px;">

   <tr><td></td><td><span style="display:block;background:#303030;color:white;padding:15px;float:right;text-decoration:none;"><a href="dispro.php">Edit</a></span><td></tr>
<tr id="">

<td width="400px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;">Username :</td>
<td width="400px" ><?php echo $uname?></td>
</tr>
<tr>
<td width="400px"  style="padding:5px;font-weight:bold;color:gray;line-height:30px;">D.o.b :</td>
<td width="400px" ><?php echo $dob?></td>
</tr>
<tr>
<td width="400px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >designation :</td>
<td width="400px" ><?php echo $desig?></td>
</tr>
<tr>
<td width="400px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >qualification :</td>
<td width="400px" ><?php echo $qualify?></td>
</tr>
<tr>
<td width="400px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >Qualification pursue :</td>
<td width="400px" ><?php echo $pursue?></td>
</tr>
<tr>
<td width="400px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >Experiance at aitam :</td>
<td width="400px" ><?php echo $exp?></td>
</tr>
<tr>
<td width="400px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >Experiance :</td>
<td width="400px" ><?php echo $expe?></td>
</tr>
<tr>
<td width="400px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >D.O.J :</td>
<td width="400px" ><?php echo $doj?></td>
</tr>

<tr>
<td width="400px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >Present :</td>
<td width="400px" ><?php echo $pre?></td>
</tr>

<tr>
<td width="400px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >Scale :</td>
<td width="400px" ><?php echo $scale?></td>
</tr>

</table>
</div>
<br><br><br><br><br>
<?php
}
}
else
{
?>



<br>
<div class="wrapper">
	
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">
					<form class="register active" action="reg.php" method="POST" enctype="multipart/form-data">
						<h3>Make your profile</h3>
						<div class="column">
							<div>
								<label>Full Name:</label>
								<input type="text"  placeholder="Full name" name="fname" />
							
							</div>
							<div>
								<label>Date of birth:</label>
								<input type="date"  placeholder="yyyymmdd" name="dob"/>
								
							</div>
							<div>
								<label>Designation:</label>
								<input type="text"  placeholder="Designation" name="desig"/>
								
							</div>
							<div>
								<label>Qualification:</label>
								<input type="text" placeholder="Qualification" name="qualify"/>
								
							</div>
							<div>
								<label>Qualification pursuing:</label>
								<input type="text"  placeholder="Qualification Pursuing" name="pursue"/>
								
							</div>
							<div>
								<label>Upload your photo:</label>
								<input  type="file"  name="propic" required/>
								
							</div>
							
						</div>
						<div class="column">
							
							
							<div>
								<label>Experiance at Aitam:</label>
								<input type="text"  placeholder="In years Ex:2.5 years"  name="exp"/>
								
							</div>
							<div>
								<label>Experiance:</label>
								<input type="text" placeholder="enter your experience" name="exp2"/>
								
							</div>
							
							<div>
								<label>Date of join:</label>
								<input type="date" placeholder="yyyymmdd" name="doj"/>
								
							</div>
							<div>
								<label>Date of join of present post:</label>
								<input type="date" placeholder="yyyymmdd" name="present"/>
								
							</div>
							<div>
								<label>Scale:</label>
								<input type="text" placeholder="enter your scale" name="scale"/>
								
							</div>
						</div>
						<div class="bottom">
							
							<input type="submit" value="submit it.." />
							<div class="clear"></div>
						</div>
					</form>
					
				</div>
				<div class="clear"></div>
			</div>
			
		</div>
		<?php } ?>
</body>
</html>