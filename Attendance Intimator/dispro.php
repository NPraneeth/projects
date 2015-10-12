<html>
<head>
<title>
Welcome | On'DriVe
</title>
<link rel="stylesheet" type="text/css" href="css/myform.css" >
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
<?php

include('topmenu.php');
?>


<?php 
session_start();
include('db.php');
$name=$_SESSION['name'];
$chek=mysql_query("select * from details where uname='$name' ");


while($user=mysql_fetch_array($chek))
{
$uname=$user['name'];
$dob=$user['dob'];
$dist=$user['dist'];
$gend=$user['gend'];
$addr=$user['addr'];
$desig=$user['desig'];
$qualify=$user['qualify'];
$pursue=$user['pursue'];
$pob=$user['pob'];
$nation=$user['nation'];
$religion=$user['religion'];
$caste=$user['caste'];
$exp=$user['exp'];
$expe=$user['exp2'];
$doj=$user['doj'];
$pre=$user['present'];
$scale=$user['scale'];
$file=$user['propic'];
$_SESSION['pic']=$file;

}

?>

<!--<div style="float:right;position:absolute;top:0px;right:0px;height:160px;margin:0;padding:0;width:150px;
background:url('<?php  echo $file?>');background-size:cover;background-repeat:no-repeat;"></div>-->

<br>
<div class="wrapper">
	
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">
					<form class="register active" action="reg.php" method="POST" enctype="multipart/form-data">
						<h3>Make your profile</h3>
						<div class="column">
							<div>
								<label>Full Name:</label>
								<input type="text"  placeholder="Full name" name="fname" value="<?php echo $uname;?>"/>
							
							</div>
							<div>
								<label>Date of birth:</label>
								<input type="date"  placeholder="yyyymmdd" name="dob" value="<?php echo $dob;?>"/>
								
							</div>
							
							<div>
								<label>District:</label>
								<input type="text"  placeholder="District" name="dist"  value="<?php echo $dist;?>"/>
								
							</div>
							<div >
			 					<label >Gender: &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp 
								<?php if($gend=='male'|| $gend=='female'){?>
								<input style=""type="text" name="gend"  value="<?php echo $gend;?>" ></input>
								
								<?php } else {
								
								?>
								
								
							
								<input type="radio" name="gend"  value="male"  >Male</input> &nbsp  &nbsp  &nbsp  &nbsp 
								<input type="radio" name="gend"  value="female" >Female</input>
								<?php }?>
								</label>
							</div>
							
							<div>
								<label>Address for communication:</label>
								<input type="text"  placeholder="permanent address" name="addr"  value="<?php echo $addr;?>"/>
								
							</div>
							<div>
								<label>Designation:</label>
								<input type="text"  placeholder="Designation" name="desig" value="<?php echo $desig;?>"/>
								
							</div>
							<div>
								<label>Qualification:</label>
								<input type="text" placeholder="Qualification" name="qualify" value="<?php echo $qualify;?>"/>
								
							</div>
							<div>
								<label>Qualification pursuing:</label>
								<input type="text"  placeholder="Qualification Pursuing" name="pursue"  value="<?php echo $pursue;?>"/>
								
							</div>
							<div>
								<label>Upload your photo:</label>
								<input  type="file"  name="propic" value="<?php echo $file ?>"  value="<?php echo $file;?>"/>
								
							</div>
							
						</div>
						<div class="column">
							
							<div>
								<label>Place of birth:</label>
								<input type="text"  placeholder="Place of birth" name="pob"  value="<?php echo $pob;?>"/>
								
							</div>
							<div>
								<label>Nationality:</label>
								<input type="text"  placeholder="Nationality" name="nation"  value="<?php echo $nation;?>"/>
								
							</div>
							<div>
								<label>Religion:</label>
								<input type="text"  placeholder="Religion" name="religion"  value="<?php echo $religion;?>"/>
								
							</div>
							<div>
								<label>Caste:</label>
								<input type="text"  placeholder="caste" name="caste"   value="<?php echo $caste;?>"/>
								
							</div>
							<div>
								<label>Experiance at Aitam:</label>
								<input type="text"  placeholder="In years Ex:2.5 years"  name="exp" value="<?php echo $exp;?>"/>
								
							</div>
							<div>
								<label>Experiance:</label>
								<input type="text" placeholder="enter your experience" name="exp2"  value="<?php echo $expe;?>"/>
								
							</div>
							
							<div>
								<label>Date of join:</label>
								<input type="date" placeholder="yyyymmdd" name="doj"  value="<?php echo $doj;?>"/>
								
							</div>
							<div>
								<label>Date of join of present post:</label>
								<input type="date" placeholder="yyyymmdd" name="present"  value="<?php echo $pre;?>"/>
								
							</div>
							<div>
								<label>Scale:</label>
								<input type="text" placeholder="enter your scale" name="scale"  value="<?php echo $scale;?>"/>
								
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
		
</body>
</html>