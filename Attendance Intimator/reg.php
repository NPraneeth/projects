<?php
session_start();



include('db.php');
if(isset($_POST))
{
$hi=$_SESSION['name'];
$fname=$_POST['fname'];
$dob=$_POST['dob'];
$dist=$_POST['dist'];
$gend=$_POST['gend'];
$addr=$_POST['addr'];
$desig=$_POST['desig'];
$qualify=$_POST['qualify'];
$pursue=$_POST['pursue'];
$pob=$_POST['pob'];
$nation=$_POST['nation'];
$religion=$_POST['religion'];
$caste=$_POST['caste'];
$exp=$_POST['exp'];
$expe=$_POST['exp2'];
$doj=$_POST['doj'];
$pre=$_POST['present'];
$scale=$_POST['scale'];
$check='$uname';
$propic=$_FILES['propic']['name'];
//$size=$_FILES['ffile1']['size'];
//$type=$_FILES['ffile1']['type'];
//$error=$_FILES['ffile1']['error'];
$tmp_loc=$_FILES['propic']['tmp_name'];
$myloc='pros/';
$org_loc=$myloc.$propic;
$tc=mysql_query("select * from details where uname='$hi' ");

if(move_uploaded_file($tmp_loc,$myloc.$propic))
{
if(mysql_num_rows($tc)>0)
{
$propic=$_SESSION['pic'];
$in=mysql_query("update details set name='$fname' ,dob='$dob',dist='$dist',gend='$gend',addr='$addr',desig='$desig',qualify='$qualify',pursue='$pursue',pob='$pob',nation='$nation',religion='$religion',caste='$caste',exp='$exp',exp2='$expe',doj='$doj',present='$pre',
scale='$scale',propic='$org_loc'where uname='$hi'");
if($in)
{
echo 'updated success';
$_SESSION['propic']=$org_loc;
echo "<meta http-equiv='refresh' content='1;url=profile.php' >";
}
else
{
echo 'failed to update';
}
}

else
{



$in=mysql_query("insert into details values('','$hi','$fname','$dob','$dist','$gend','$addr','$desig','$qualify','$pursue','$pob','$nation','$religion','$caste','$exp','$expe','$doj','$pre','$scale','$org_loc')");
if($in)
{
echo 'insert success';
$_SESSION['propic']=$org_loc;
echo "<meta http-equiv='refresh' content='1;url=profile.php' >";
}
else
{
echo 'failsss';
}








}

}
}
?>
