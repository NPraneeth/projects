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
<?php

include('topmenu.php');
?>

<br><br><br>
<?php
include('db.php');
session_start();
$uname=$_SESSION['name'];
$check=mysql_query("select * from drive where name='$uname' ");
if(mysql_num_rows($check)>0)
{
?>
<br>
<a href="i_drive.php" style="position:fixed;right:0px;float:right;display:block;background:#303030;padding:15px;">Add new</a>
<br><br>
<?php

include('db.php');


$uname=$_SESSION['name'];

$list=mysql_query("select * from drive  where name='$uname' order by id desc");
$co=mysql_num_rows($list);
$i=$co;
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
<div style="border:1px solid black;padding:50px;display:block;width:550px;margin-left:20%;">
 <table border="0"   >
<tr><td colspan="2" style="text-align:center;color:black;"><h2 style="font-size:2.3em;">Journal No:<?php echo $i ;$i=$i-1;?></h2></td></tr>
        <tr>
<td width="160px"  style="padding:5px;font-weight:bold;color:gray;line-height:30px;">User name :</td>
<td width="350px" ><span style="margin-left:100px;"><?php echo $uname?></span></td>
</tr>
<tr id="">

<td width="160px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;">Author name :</td>
<td width="350px" ><span style="margin-left:100px;"><?php echo $aname?></span></td>
</tr>
<tr>
<td width="160px"  style="padding:5px;font-weight:bold;color:gray;line-height:30px;">Department :</td>
<td width="350px" ><span style="margin-left:100px;"><?php echo $dept?></span></td>
</tr>
<tr>
<td width="160px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >title :</td>
<td width="350px" ><span style="margin-left:100px;"><?php echo $title?></span></td>
</tr>
<tr>
<td width="160px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >Journal Name :</td>
<td width="350px" ><span style="margin-left:100px;"><?php echo $j_name?></span></td>
</tr>
<tr>
<td width="160px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >Issue Number  :</td>
<td width="350px" ><span style="margin-left:100px;"><?php echo $i_no?></span></td>
</tr>
<tr>
<td width="160px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >ISBN/ISSN No  :</td>
<td width="350px" ><span style="margin-left:100px;"><?php echo $issn?></span></td>
</tr>
<tr>
<td width="160px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >Impact :</td>
<td width="350px" ><span style="margin-left:100px;"><?php echo $i_pact?></span></td>
</tr>
<tr>
<td width="160px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >C.I :</td>
<td width="350px" ><span style="margin-left:100px;"><?php echo $ci?></span></td>
</tr>

<tr>
<td width="160px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >D.O.I :</td>
<td width="350px" ><span style="margin-left:100px;"><?php echo $doi?></span></td>
</tr>
<tr>
<td width="160px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >Other info :</td>
<td width="350px" ><span style="margin-left:100px;"><?php echo $other?></span></td>
</tr>

</table>
</div>
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
								<input type="text"  placeholder="department" name="dept"/>
								
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
								<input type="date" placeholder="Date of issue" name="doi"/>
								
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