<html>
<head>
<style>

#sub{
display:block;
background:#303030;
padding:10px 30px;
border-radius:10px;
color:white;
font-size:1em;
font-family:calibri;
}
#sub:hover
{
cursor:pointer;
}
input[type="text"],input[type="password"]
{
padding:10px;
border-radius:5px;
width:80%;
border:1px solid pink;
}
</style>
</head>
<body style="background-image:url('clg.jpg');background-size:cover;background-repeat:no-repeat;background-attachment:fixed;margin:0;">
<div style="display:block;height:100%;width:100%;background:#303030;background:rgba(0,0,0,.8);margin:0;background-attachment:fixed;background-size:cover;"></div>

<div style="position:absolute;top:25%;left:35%;width:400px;border:1px solid pink;background:white;background:rgba(0,0,0,.5);">
<div style="display:block;color:white;background:#303030;width:85%;padding:30px;font-family:sans-serif;font-size:1.3em;text-align:center;">Admin Panel</div>
<center><form action="#" method="POST"><br>
<input type="text" placeholder="ADMIN_NAME" name="adminu" required><br><br>
<input type="password" placeholder="PASSWORD" name="adminp" required><br><br></center>
<center><input type="submit" id="sub"name="admin"value="Access"></center>
<br>
</form>
</div>
<?php

include('db.php');
session_start();
if(isset($_POST['admin']))
{
$adminu=$_POST['adminu'];
$adminp=$_POST['adminp'];
$check=mysql_query("select * from admin where adminu='$adminu' && adminp='$adminp' ");
if(mysql_num_rows($check)>0)
{
$_SESSION['adminu']=$adminu;
echo "<meta http-equiv='refresh' content='0;url=admin_in.php' >";
}
else
{
echo "<script>alert('admins can only enter here');</script>";
}
}
?>
</body>

</html>