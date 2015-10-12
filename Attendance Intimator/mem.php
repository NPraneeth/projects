<html>
<head>
<title>
Welcome | On'DriVe
</title>

 <link rel="stylesheet" type="text/css" href="wel.css">
</head>
<body style="background:url('hh.jpg');
background-size:cover;background-repeat:no-repeat;
">
<?php

include('topmenu.php');
?>
<br>
<br>
<br>
<table id="hello"width="500px">
<tr>
<th>Sl.No</th>
<th>Faculty Name</th>
</tr>



<?php

include('db.php');
$list=mysql_query("select * from f_list");

while($hai=mysql_fetch_array($list))
{
$name=$hai[0];
$pass=$hai[1];
?>

<tr>
<td>
<?php echo $name;?></td>
<td><?php echo $pass; ?></td>
</tr>



<?php
}
?>
</table>
</body>
</html>



