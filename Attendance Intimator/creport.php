<?php
session_start();
include('db.php');
if(isset($_POST))
{
$uname=$_SESSION['name'];

$branch=$_POST['branch'];
$c_date=$_POST['c_date'];
$students=$_POST['student'];
$abs=$_POST['absant'];
$remark=$_POST['remark'];


}

if($uname=='' ||  $branch=='' || $c_date=='' || $students=='' || $abs=='' || $remark=='')
{

$emp="values must not be empty";
 $_SESSION['emp']=$emp;
 echo "<meta http-equiv='refresh' content='0;url=c_report.php'>";
 }
else
{
$in=mysql_query("insert into creq values('','$uname','$branch','$c_date','$students','$abs','$remark')");
if($in)
{
echo 'success';
echo "<meta http-equiv='refresh' content='0;url=c_report.php' >";
}
else
{
echo 'failsss';
}
}

?>
