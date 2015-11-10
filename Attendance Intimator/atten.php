<?php
session_start();



include('db.php');
if(isset($_POST))
{
$namef=$_SESSION['name'];
$year=$_POST['year'];
$sem=$_POST['sem'];
$branch=$_POST['branch'];
$section=$_POST['section'];
$period=$_POST['period'];
$subject=$_POST['subj'];
$date=$_POST['date'];
$atte=$_POST['atte'];

$in=mysql_query("insert into atten values('','$namef','$year','$sem','$branch','$section','$period','$subject','$date','$atte') ");
if($in)
{
echo "<script>alert('submitted successfully')</script>";

echo "<meta http-equiv='refresh' content='1;url=att.php' >";
}
else
{
echo "<script>alert('Failed to submit,try again.')</script>";
}
}
?>
