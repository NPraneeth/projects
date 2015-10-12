<?php
session_start();
if(!isset($_SESSION['name'])){
header('Location: index.php');
}

?>
<html>
<head>

<title>
Welcome | On'DriVe
</title>
<link rel="stylesheet" type="text/css" href="css/myform.css" />
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
<br>
      
<?php
include('db.php');


$uname=$_SESSION['name'];

$list=mysql_query("select * from creq where name='$uname' ");
if(mysql_num_rows($list)>0)
{

?>
 <a href="discon.php" style="position:fixed;right:0px;float:right;display:block;background:#303030;color:white;text-decoration:none;padding:15px;">Add new</a>
 
<div style="margin-left:12%;margin-top:10%;width:1100px;">
       <table border="1"  style="border-collapse:collapse;"width="100%">
	 <tr style="background:#303030;">	   

<th width="100px"  style="text-align:center;padding:5px;font-weight:bold;color:gray;line-height:30px;">Branch :</th>
<th width="100px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >Counselling date :</th>
<th width="100px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >N0.of students alloted :</th>
<th width="100px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" >Absentees :</th>
<th width="100px" style="padding:5px;font-weight:bold;color:gray;line-height:30px;" > remarks  :</th>

      </tr>

	  <?php
while($user=mysql_fetch_array($list))
{
$uname=$user['name'];

$branch=$user['branch'];
$c_date=$user['c_date'];
$students=$user['student'];
$abs=$user['absant'];
$remark=$user['remark'];
?>



	  
        

<tr height="100px;">

<td width="100px" style="text-align:center;"><?php echo $branch?></td>
<td width="100px"  style="text-align:center;"><?php echo $c_date?></td>
<td width="100px"  style="text-align:center;"><?php echo $students?></td>
<td width="100px" style="text-align:center;" ><?php echo $abs?></td>
<td width="100px"  style="text-align:center;"><?php echo $remark?></td>

</tr>





		
     
	

<?php }

?>
</table>

</div>

<?php
 }
else
{
?>
<div class="wrapper">
	
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">
					<center><form class="register active" action="creport.php" method="POST" enctype="multipart/form-data">
						<h3>Counselling Report</h3>
						<div class="column">
							<div>
								<label>Branch:</label>
								<select type="input" name="branch">
    
	<option>1st cse-A (1-20)</option>
   <option>1st cse-A (21-40)</option>
   <option>1st cse-A (41-60)</option>
   <option>1st cse-B (1-20)</option>
   <option>1st cse-B (21-40)</option>
   <option>1st cse-B (41-60)</option>
   <option>1st cse-C (1-20)</option>
   <option>1st cse-C (21-40)</option>
   <option>1st cse-C (41-60)</option>
     <option>2nd cse-A (1-20)</option>
   <option>2nd cse-A (21-40)</option>
   <option>2nd cse-A (41-60)</option>
   <option>2nd cse-B (1-20)</option>
   <option>2nd cse-B (21-40)</option>
   <option>2nd cse-B (41-60)</option>
   <option>2nd cse-C (1-20)</option>
   <option>2nd cse-C (21-40)</option>
   <option>2nd cse-C (41-60)</option>
   <option>3rd cse-A (1-20)</option>
   <option>3rd cse-A (21-40)</option>
   <option>3rd cse-A (41-60)</option>
   <option>3rd cse-B (1-20)</option>
   <option>3rd cse-B (21-40)</option>
   <option>3rd cse-B (41-60)</option>
   <option>3rd cse-C (1-20)</option>
   <option>3rd cse-C (21-40)</option>
   <option>3rd cse-C (41-60)</option>
    <option>4th cse-A (1-20)</option>
   <option>4th cse-A (21-40)</option>
   <option>4th cse-A (41-60)</option>
   <option>4th cse-B (1-20)</option>
   <option>4th cse-B (21-40)</option>
   <option>4th cse-B (41-60)</option>
   </select>
							</div>
							
							<div>
								<label>Counselling Date :</label>
								<input type="date" placeholder="date" name="c_date"/>
								
							</div>
							<div>
								<label>No.of students alloted :</label>
								<input type="text" placeholder="No.of students" name="student"/>
								
							</div>
							<div>
								<label>Absentees :</label>
								<input type="text" placeholder="Absentees" name="absant">
								
							</div>
							<div>
								<label> remarks:</label>
								<textarea type="input" placeholder="Remarks" name="remark" style="margin-left:20%;"></textarea>
								
							</div>
							<input type="submit">
						</div>
						
					</form></center>
					
				</div>
				<div class="clear"></div>
			</div>
			
		</div>
<?php
}
?>
</body>
</html>