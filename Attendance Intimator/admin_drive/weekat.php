<?php
session_start();
include('db.php');
if(!$_SESSION['adminu'])
{
echo "<meta http-equiv='refresh' content='0;url=index.php' >";
}
?>
<html>
<script type="text/javascript">
function print() {
    window.print();
}
</script>
<button onclick="print()">print</button>
  <center> <h1>
  ADITYA INSTITUTE OF TECHNOLOGY AND MANAGEMENT<br>
  WEEKLY ATTENDANCE REPORT
  
  </h1></center>
<?php

if(isset($_GET))
{

$fdate=$_GET['fdate'];
$tdate=$_GET['tdate'];
$sec=$_GET['section'];
$branch=$_GET['branch'];
$sem=$_GET['sem'];
$period=$_GET['period'];
$year=$_GET['year'];
if($year=='' && $sem='' && $section='' && $period='' && $branch='')
{
if($fdate!='' && $tdate!='')
{
$list=mysql_query("select * from atten where date between '$fdate' AND '$tdate' ");
}
else
{
$list=mysql_query("select * from atten");
}
}
else
{
$list=mysql_query("select * from atten   where   year='$year' && sem='$sem' && section='$sec' && period='$period' && branch='$branch' && date between '$fdate' AND '$tdate'");
}
if(mysql_num_rows($list)>0)
{

?>

<div style="margin-left:5%;margin-top:10%;width:1200px;">
       <table border="1"  width="100%" style="border-collapse:collapse;">
	 <tr style="background-color:#303030;color:white;font-family:calibri;font-size:1em;">	   

<th width="100px"  style="text-align:center;padding:5px;font-weight:bold;color:white;line-height:30px;">Faculty :</th>
<th width="100px"  style="text-align:center;padding:5px;font-weight:bold;color:white;line-height:30px;">Year :</th>
<th width="100px"  style="text-align:center;padding:5px;font-weight:bold;color:white;line-height:30px;">Sem :</th>
<th width="100px" style="padding:5px;font-weight:bold;color:white;line-height:30px;" >Branch :</th>
<th width="110px" style="padding:5px;font-weight:bold;color:white;line-height:30px;" >Section :</th>
<th width="100px" style="padding:5px;font-weight:bold;color:white;line-height:30px;" >Period :</th>
<th width="100px" style="padding:5px;font-weight:bold;color:white;line-height:30px;" >Subject :</th>
<th width="100px" style="padding:5px;font-weight:bold;color:white;line-height:30px;" >Date  :</th>
<th width="100px" style="padding:5px;font-weight:bold;color:white;line-height:30px;" >Attendance :</th>

      </tr>

	  <?php
while($user=mysql_fetch_array($list))
{
$uname=$user['name'];
$year=$user['year'];
$sem=$user['sem'];
$branch=$user['branch'];
$section=$user['section'];
$period=$user['period'];
$subject=$user['subject'];
$date=$user['date'];
$atten=$user['atten'];

?>



	  
        

<tr height="100px;">

<td width="100px" style="text-align:center;"><?php echo $uname?></td>
<td width="100px" style="text-align:center;"><?php echo $year?></td>
<td width="100px"  style="text-align:center;"><?php echo $sem?></td>
<td width="100px"  style="text-align:center;"><?php echo $branch?></td>
<td width="100px" style="text-align:center;" ><?php echo $section?></td>
<td width="100px"  style="text-align:center;"><?php echo $period?></td>
<td width="100px"  style="text-align:center;"><?php echo $subject?></td>
<td width="100px"  style="text-align:center;"><?php echo $date?></td>
<td width="100px"  style="text-align:center;"><?php echo $atten?></td>

</tr>





		
     
	

<?php } }
else 
{

if($fdate!='' && $tdate!='')
{
$list=mysql_query("select * from atten where date between '$fdate' AND '$tdate' ");
}
else
{
echo 'No results found';
}
} 

}



?>
</table>

</div>
</html>