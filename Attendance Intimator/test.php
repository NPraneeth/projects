<html>
<head>
<title>
Welcome | On'DriVe
</title>
<link rel="stylesheet" type="text/css" href="css/myform.css" />
 <link rel="stylesheet" type="text/css" href="wel.css">
 <link rel="stylesheet" type="text/css" href="pro.css">
 <link rel="stylesheet" type="text/css" href="drive.css">
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

<br><br><br>
 <table border="1" id="ids" width="auto" >

        <tr>
<th width="160px"  style="padding:5px;font-weight:bold;color:gray;line-height:30px;">User name :</th>
<th width="160px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;">Author name :</th>
<th width="160px"  style="padding:5px;font-weight:bold;color:gray;line-height:30px;">Department :</th>
<th width="160px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >title :</th>
<th width="160px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >Journal Name :</th>
<th width="160px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >Issue Number  :</th>
<th width="160px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >ISBN/ISSN No  :</th>
<th width="160px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >Impact :</th>
<th width="160px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >C.I :</th>
<th width="160px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >D.O.I :</th>
<th width="160px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >Other info :</th>
</tr>
<?php
include('db.php');
session_start();
$uname=$_SESSION['name'];
$check=mysql_query("select * from drive where name='$uname' ");
if(mysql_num_rows($check)>0)
{
?>
<br><br><br>

<?php

include('db.php');


$uname=$_SESSION['name'];

$list=mysql_query("select * from drive where name='$uname' ");
if(mysql_num_rows($list)>0)
{
while($user=mysql_fetch_array($list))
{
$uname=$user['name'];
$aname=$user['a_name'];
$dept=$user['dept'];
$title=$user['title'];
$j_name=$user['j_name'];
$i_no=$user['i_no'];
$issn=$user['issn'];
$i_pact=$user['i_pact'];
$ci=$user['ci'];
$doi=$user['doi'];
$other=$user['other'];
?>
<a href="i_drive.php">Add new</a>

<tr id="">
<td width="350px" ><span style="margin-left:100px;"><?php echo $uname?></span></td>
<td width="350px" ><span style="margin-left:100px;"><?php echo $aname?></span></td>
<td width="350px" ><span style="margin-left:100px;"><?php echo $dept?></span></td>
<td width="350px" ><span style="margin-left:100px;"><?php echo $title?></span></td>
<td width="350px" ><span style="margin-left:100px;"><?php echo $j_name?></span></td>
<td width="350px" ><span style="margin-left:100px;"><?php echo $i_no?></span></td>
<td width="350px" ><span style="margin-left:100px;"><?php echo $issn?></span></td>
<td width="350px" ><span style="margin-left:100px;"><?php echo $i_pact?></span></td>
<td width="350px" ><span style="margin-left:100px;"><?php echo $ci?></span></td>
<td width="350px" ><span style="margin-left:100px;"><?php echo $doi?></span></td>
<td width="350px" ><span style="margin-left:100px;"><?php echo $other?></span></td>
</tr>


</table>
<br><br><br><br><br>
		
     
	

<?php } }
else
{
echo "not found";
}

}
else
{ ?>

<div class="wrapper">
	
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">
					<form class="register active" action="driveup.php" method="POST" enctype="multipart/form-data">
						<h3 style="text-align:center;">Add Journal to your Drive</h3>
						<div class="column">
							<div>
								<label>Author Name:</label>
								<input type="text"  placeholder="Author name" name="a_name"  />
							
							</div>
							<div>
								<label>Department:</label>
								<input type="date"  placeholder="department" name="dept"/>
								
							</div>
							<div>
								<label>Title:</label>
								<input type="text"  placeholder="Title" name="title"/>
								
							</div>
							<div>
								<label>Journal:</label>
								<input type="text" placeholder="Journal/publisher" name="j_name"/>
								
							</div>
							<div>
								<label>Issue No:</label>
								<input type="text" placeholder="Issue/page no" name="i_no"/>
								
							</div>
							<div>
								<label>Upload your Document:</label>
								<input  type="file"  name="doc" required/>
								
							</div>
							
						</div>
						<div class="column">
							
							
							<div>
								<label>ISBN/ISSN No:</label>
								<input type="text"  placeholder="ISBN/ISSN" name="issn"/>
								
							</div>
							<div>
								<label>Impact:</label>
								<input type="text" placeholder="Impact" name="i_pact"/>
								
							</div>
							
							<div>
								<label>C.I:</label>
								<input type="date" placeholder="C.I" name="ci"/>
								
							</div>
							<div>
								<label>D.O.I:</label>
								<input type="text" placeholder="Date of issue" name="doi"/>
								
							</div>
							<div>
								<label>Some discription:</label>
								<textarea type="input" placeholder="Other info" name="other"rows="5" cols="35"></textarea>
								
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
		<?php
}
?>
		</body>
</html>