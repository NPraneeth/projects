<?php
session_start();
if(!isset($_SESSION['name'])){
header('Location: index.php');
}

?>
<html>
<head>

<title>
Welcome | On'DriVe
</title>
<link rel="stylesheet" type="text/css" href="css/myform.css" />
 <link rel="stylesheet" type="text/css" href="wel.css">
 <link rel="stylesheet" type="text/css" href="pro.css">
 <link rel="stylesheet" type="text/css" href="drive.css">
 <link rel="stylesheet" type="text/css" href="css/c_report.css">
 <link rel="stylesheet" type="text/css" href="css/tabs.css">
</head>
<body style="background:url('hh.jpg');
background-size:cover;background-repeat:no-repeat;
">
<?php

include('topmenu.php');
?>





 <a href="c_report.php" style="position:fixed;right:0px;float:right;display:block;background:#303030;color:white;text-decoration:none;padding:15px;">view</a>

 
 
 
<div class="wrapper">
	
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">
					<form class="register active" action="creport.php" method="POST" enctype="multipart/form-data">
						<h3>Counselling Report</h3>
						<div class="column" style="margin-left:20%;">
							<div>
								<label>Branch:</label>
								<select type="input" name="branch" required>
   <option value="">choose branch</option>
   <option>1st cse-A (1-20)</option>
   <option>1st cse-A (21-40)</option>
   <option>1st cse-A (41-60)</option>
   <option>1st cse-B (1-20)</option>
   <option>1st cse-B (21-40)</option>
   <option>1st cse-B (41-60)</option>
   <option>1st cse-C (1-20)</option>
   <option>1st cse-C (21-40)</option>
   <option>1st cse-C (41-60)</option>
     <option>2nd cse-A (1-20)</option>
   <option>2nd cse-A (21-40)</option>
   <option>2nd cse-A (41-60)</option>
   <option>2nd cse-B (1-20)</option>
   <option>2nd cse-B (21-40)</option>
   <option>2nd cse-B (41-60)</option>
   <option>2nd cse-C (1-20)</option>
   <option>2nd cse-C (21-40)</option>
   <option>2nd cse-C (41-60)</option>
  <option>3rd cse-A (1-20)</option>
   <option>3rd cse-A (21-40)</option>
   <option>3rd cse-A (41-60)</option>
   <option>3rd cse-B (1-20)</option>
   <option>3rd cse-B (21-40)</option>
   <option>3rd cse-B (41-60)</option>
   <option>3rd cse-C (1-20)</option>
   <option>3rd cse-C (21-40)</option>
   <option>3rd cse-C (41-60)</option>
    <option>4th cse-A (1-20)</option>
   <option>4th cse-A (21-40)</option>
   <option>4th cse-A (41-60)</option>
   <option>4th cse-B (1-20)</option>
   <option>4th cse-B (21-40)</option>
   <option>4th cse-B (41-60)</option>
   </select>
							</div>
							
							<div>
								<label>Counselling Date :</label>
								<input type="date" placeholder="date" name="c_date" required/>
								
							</div>
							<div>
								<label>No.of students alloted :</label>
								<input type="text" placeholder="No.of students" name="student" required/>
								
							</div>
							<div>
								<label>Absentees :</label>
								<input type="text" placeholder="Absentees" name="absant" required>
								
							</div>
							<div>
								<label> remarks:</label>
								<textarea type="input" placeholder="Remarks" name="remark" style="margin-left:9%;" required></textarea>
								
							</div>
							<input type="submit">
						</div>
						
					</form>
					
				</div>
				<div class="clear"></div>
			</div>
			
		</div>
		
 
</table>
</center>
</body>
</html>