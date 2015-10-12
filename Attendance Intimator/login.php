<?php
include('db.php');
session_start();
if(isset($_POST))
{
$uname=$_POST['uname'];
$pass=$_POST['pass'];
if($uname== '' || $pass=='')
{
 $emp="values must not be empty";
 $_SESSION['emp']=$emp;
 echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}
else
{
$proc=mysql_query("select * from f_list where uname='$uname' && pass='$pass' ");
$proc2=mysql_query("select * from details where uname='$uname'");
if(mysql_num_rows($proc)>0)
{
$_SESSION['name']=$uname;
if(mysql_num_rows($proc2)>0)
{
while($row=mysql_fetch_array($proc2))
{
$pic=$row['propic'];
$_SESSION['mypro']=$pic;
$hpic=$_SESSION['mypro'];
}
}
else
{
$dum="pros/dummy.png";
$_SESSION['mypro']=$dum;
$hpic=$_SESSION['mypro'];
}
$emp="Loading";
$_SESSION['emp']=$emp;
echo "<meta http-equiv='refresh' content='0;url=welcome.php'>";
}
else
{
$emp="Invalid credentials";
$_SESSION['emp']=$emp;
echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}
}
}
?>