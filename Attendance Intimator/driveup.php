<?php
session_start();
include('db.php');
if(isset($_POST))
{
$uname=$_SESSION['name'];
$a_name=$_POST['a_name'];
$dept=$_POST['dept'];
$title=$_POST['title'];
$j_name=$_POST['j_name'];
$i_no=$_POST['i_no'];
$issn=$_POST['issn'];
$i_pact=$_POST['i_pact'];
$ci=$_POST['ci'];
$doi=$_POST['doi'];
$other=$_POST['other'];

if($uname=='' || $a_name=='' || $dept=='' || $title=='' || $j_name=='' || $i_no=='' || $issn=='' || $i_pact=='' || $ci=='' || $doi==''|| $other=='')
{

$emp="values must not be empty";
 $_SESSION['emp']=$emp;
 echo "<meta http-equiv='refresh' content='3;url=mydrive.php'>";
 }
else
{
$in=mysql_query("insert into drive values('','$uname','$a_name','$dept','$title','$j_name','$i_no','$issn','$i_pact','$ci','$doi','$other')");
if($in)
{
echo 'success';
echo "<meta http-equiv='refresh' content='1;url=mydrive.php' >";
}
else
{
echo 'failsss';
}
}
}
?>
