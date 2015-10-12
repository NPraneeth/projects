<?php
session_start();
if(!isset($_SESSION['name'])){
header('Location: index.php');
}

?>
<html>
<body style="background:#303030;">
<?php 
include('db.php');
session_start();
$key=$_SESSION['key'];
$q=mysql_query("select * from comm where mykey='$key' ");
if(mysql_num_rows($q)>0)
{
	while($row=mysql_fetch_array($q))
	{
		$roll=$row['roll'];
		$key=$row['mykey'];
		
	}
	
	$c=mysql_query("select id,roll,comp,DATE_FORMAT(datee,'%m/%d/%Y') datee from comp where roll='$roll'");
	if(mysql_num_rows($c)>0)
	{?>
		<div style="display:block;background:#F8F8F8;padding:0px;font-family:calibri;width:600px;color:gray;position:absolute;top:10%;left:30%;height:500px;overflow:auto;">
		<span style="font-family:calibri;text-align:center;display:block;color:white;background:pink;padding:30px;font-weight:bold;font-size:1.5em;margin:0;width:100%;">Complaint Box<a style="display:inline-block;background:gray;padding:5px 10px;color:white;float:right;margin-right:50px;text-decoration:none;" href="plogin.php">X</a></span>
		<div style="padding:30px;">
		<span style="font-family:calibri;font-weight:bold;font-size:1.3em;">Your Ward Roll No. <?php echo $roll; ?><br><br></span>
		<?php
		while($row2=mysql_fetch_array($c))
		{
			$rolln=$row2['roll'];
			$compp=$row2['comp'];
			$datee=$row2['datee'];
			?>
			
			<?php 
			echo "<br><b>Complaint: </b><br><br>".$compp ."<br><span style='float:right;font-size:0.8em;color:black;'> (on ".$datee.")</span> <br>";
			
			
		}?>
		</div>
		</div>
		<?php
		
	}
	else
	{
		?>
		<span style="font-family:calibri;font-weight:bold;font-size:2em;position:absolute;top:20%;left:30%;display:block;background:white;color:gray;padding:30px;">No Complaints Recorded .</span>
		<?php
	}
}
?>
</body>
</html>