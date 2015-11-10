<?php
include('db.php');
session_start();
if(isset($_POST))
{

$pass=$_POST['key'];
if( $pass=='')
{
 $emp="values must not be empty";
 $_SESSION['emp']=$emp;
 echo "<meta http-equiv='refresh' content='0;url=parent.php'>";
}
else
{
$proc=mysql_query("select * from comm where mykey='$pass' ");

if(mysql_num_rows($proc)>0)
{
$_SESSION['key']=$pass;
$emp="You already logged in...";

echo "<meta http-equiv='refresh' content='0;url=phome.php'>";
}
else
{
$emp="Invalid credentials";
$_SESSION['emp']=$emp;
echo "<meta http-equiv='refresh' content='0;url=parent.php'>";
}
}
}
?>