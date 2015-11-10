<html>
<head>

<title>
Welcome | On'DriVe
</title>

 <link rel="stylesheet" type="text/css" href="wel.css">
 <link rel="stylesheet" type="text/css" href="pro.css">
 <link rel="stylesheet" type="text/css" href="drive.css">
 <link rel="stylesheet" type="text/css" href="css/c_report.css">
 <link rel="stylesheet" type="text/css" href="css/tabs.css">
</head>
<body>
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
session_start();
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

<html>
<body>       
     
       <table border="0" id="ids" width="600px;" >

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
<br><br><br><br><br>
		
     
	

<?php } }
else
{
echo "not found";
}
?>
</body>
</html>