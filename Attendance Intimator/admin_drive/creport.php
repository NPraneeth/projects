<?php
session_start();
include('db.php');
if(!$_SESSION['adminu'])
{
echo "<meta http-equiv='refresh' content='0;url=index.php' >";
}
?>
<html>
<script src="main.js"></script>
<script src="vid.js"></script>
<script type="text/javascript">
function print() {
    window.print();
}
</script>
<button onclick="print()">print</button>
<head>
<title>Counselling Report</title>
</head>


    <center> <h1>
  ADITYA INSTITUTE OF TECHNOLOGY AND MANAGEMENT<br>
  COUNSELLING REPORT
  
  </h1></center>
<?php




$list=mysql_query("select * from creq  order by name desc");
if(mysql_num_rows($list)>0)
{

?>

<div style="margin-left:5%;margin-top:10%;width:90%;">
       <table border="1"  width="100%" style="border-collapse:collapse;">
	 <tr style="background-color:#303030;color:white;font-family:calibri;font-size:1em;">	   

<th width="100px"  style="text-align:center;padding:5px;font-weight:bold;color:white;line-height:30px;">Faculty Name :</th>
<th width="100px"  style="text-align:center;padding:5px;font-weight:bold;color:white;line-height:30px;">Branch :</th>
<th width="100px" style="padding:5px;font-weight:bold;color:white;line-height:30px;" >Counselling date :</th>
<th width="110px" style="padding:5px;font-weight:bold;color:white;line-height:30px;" >No.of students alloted :</th>
<th width="100px" style="padding:5px;font-weight:bold;color:white;line-height:30px;" >Absentees :</th>
<th width="100px" style="padding:5px;font-weight:bold;color:white;line-height:30px;" >Faculty remarks  :</th>

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

<td width="100px" style="text-align:center;"><?php echo $uname?></td>
<td width="100px" style="text-align:center;"><?php echo $branch?></td>
<td width="100px"  style="text-align:center;"><?php echo $c_date?></td>
<td width="100px"  style="text-align:center;"><?php echo $students?></td>
<td width="100px" style="text-align:center;" ><?php echo $abs?></td>
<td width="100px"  style="text-align:center;"><?php echo $remark?></td>

</tr>





		
     
	

<?php } }

?>
</table>

</div>
</html>