<?php 
include('db.php');
error_reporting(0);
if(isset($_POST['st']))
{
	$roll=$_POST['roll'];
	$key=$_POST['keyy'];
	$f=mysql_query("insert into comm values('','$roll','$key')");
	if($f)
	{
	echo "<script>alert('Added Successfully')</script>";
	echo "<meta http-equiv='refresh' content='0;url=par.php' >";
	}
	else
	{
		echo "<script>alert('Failed to add')</script>";
	echo "<meta http-equiv='refresh' content='0;url=par.php' >";
	}
	
	


}

?>
<?php
include('db.php');
error_reporting(0);
if(isset($_POST['me']))
{
	$rolln=$_POST['rolln'];
	$comp=$_POST['comp'];
	$date=$_POST['date'];
	$f=mysql_query("insert into comp values('','$rolln','$comp','$date')");
	if($f)
	{
	echo "<script>alert('Added Successfully')</script>";
	echo "<meta http-equiv='refresh' content='0;url=par.php' >";
	}
	else
	{
		echo "<script>alert('Failed to add')</script>";
	echo "<meta http-equiv='refresh' content='0;url=par.php' >";
	}
	
	


}
?>