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
background-size:cover;background-repeat:no-repeat;background-attachement:fixed;
">
<table width="80%" border="0" style="position:absolute;top:0;">
 <tr>
 <img src="aitamban.gif" height="70px" style="margin-left:50px;"><br>
<h4 style="margin-left:125px;margin-top:-3px;color:purple;">AN <B>AUTONOMOUS</B> INSTITUTION & AFFILIATED TO <B>JNTUKAKINADA</B></h4>
 </tr>
 
 

 </table>
 <span id="mylogo" style="">On'DriVe</span>

<!--<div style="display:block;position:absolute;top:30%;left:30%;padding:50px;background:#014965;color:white;font-size:3em;">Coming Soon ...</div>-->
<div id="menu">
<ul>
<li><a href="welcome.php">HOME</a></li>
<li><a href="profile.php">PROFILE</a></li>
<li><a href="mydrive.php">DRIVE</a></li>
<li><a href="mem.php">MEMBERS</a></li>
<li><a href="c_report.php">COUNSELLING REPORT</a></li>
<li><a href="acc.php">ACCOUNT</a></li>
<li><a href="logout.php">LOGOUT</a></li>
</ul>
</div>





 <a href="c_report.php" style="position:fixed;right:0px;float:right;display:block;background:#303030;color:white;text-decoration:none;padding:15px;">view</a>

 
 
 
<div class="wrapper">
	
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">
					<form class="register active" action="creport.php" method="POST" enctype="multipart/form-data">
						<h3>Counselling Report</h3>
						<div class="column">
							<div>
								<label>Branch:</label>
								<select type="input" name="branch">
   <option>3rd-cse-A</option>
   <option>3rd-cse-B</option>
   <option>3rd-cse-C </option>
  
   </select>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js"></script>
<script type="text/javascript" src="js/mock.js"></script>
   	<script src="js/drop.js"></script>
   <br>
<div id="example1" class="bs-docs-example">
<select class="step1">
<option value="">Please select an option</option>
<option>Option1</option>
<option>Option2</option>
<option>Option3</option>
<option>Option4</option>
</select>
<select class="step2">
<option value="">Please select an option</option>
<option>Option5</option>
<option>Option6</option>
<option>Option7</option>
<option>Option8</option>
</select>
<select class="step3">
<option value="">Please select an option</option>
<option>Option9</option>
<option>Option10</option>
<option>Option11</option>
<option>Option12</option>
</select>
</div>
<script>
$('#example1').cascadingDropdown({
selectBoxes: [
{
selector: '.step1'
},
{
selector: '.step2',
requires: ['.step1']
},
{
selector: '.step3',
requires: ['.step1', '.step2']
}
]
});
</script>
							</div>
							
							<div>
								<label>Counselling Date :</label>
								<input type="date" placeholder="date" name="c_date"/>
								
							</div>
							<div>
								<label>No.of students alloted :</label>
								<input type="text" placeholder="No.of students" name="student"/>
								
							</div>
							<div>
								<label>Absentees :</label>
								<input type="text" placeholder="Absentees" name="absant">
								
							</div>
							<div>
								<label>Faculty remarks:</label>
								<textarea type="input" placeholder="Remarks" name="remark" style="margin-left:20%;"></textarea>
								
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