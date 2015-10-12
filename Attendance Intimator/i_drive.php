<html>
<head>
<title>
Welcome | On'DriVe
</title>
<link rel="stylesheet" type="text/css" href="css/myform.css" />
 <link rel="stylesheet" type="text/css" href="wel.css">
 <link rel="stylesheet" type="text/css" href="pro.css">
 <link rel="stylesheet" type="text/css" href="drive.css">
</head>
<body style="background:url('hh.jpg');
background-size:cover;background-repeat:no-repeat;
">
<?php

include('topmenu.php');
?>

<br>
<a href="mydrive.php" style="position:fixed;right:0px;float:right;display:block;background:#303030;color:white;text-decoration:none;padding:15px;">Go back to drive</a>

<br><br>
<?php
include('db.php');
session_start();
?>
<br><br><br>
 


<div class="wrapper">
	
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">
					<form class="register active" action="driveup.php" method="POST" enctype="multipart/form-data">
						<h3 style="text-align:center;">Add Journal to your Drive</h3>
						<div class="column">
							<div>
								<label>Author Name:</label>
								<input type="text"  placeholder="Author name" name="a_name"  />
							
							</div>
							<div>
								<label>Department:</label>
								<input type="text"  placeholder="department" name="dept"/>
								
							</div>
							<div>
								<label>Title:</label>
								<input type="text"  placeholder="Title" name="title"/>
								
							</div>
							<div>
								<label>Journal:</label>
								<input type="text" placeholder="Journal/publisher" name="j_name"/>
								
							</div>
							<div>
								<label>Issue No:</label>
								<input type="text" placeholder="Issue/page no" name="i_no"/>
								
							</div>
							<div>
								<label>Upload your Document:</label>
								<input  type="file"  name="doc" required/>
								
							</div>
							
						</div>
						<div class="column">
							
							
							<div>
								<label>ISBN/ISSN No:</label>
								<input type="text"  placeholder="ISBN/ISSN" name="issn"/>
								
							</div>
							<div>
								<label>Impact:</label>
								<input type="text" placeholder="Impact" name="i_pact"/>
								
							</div>
							
							<div>
								<label>C.I:</label>
								<input type="date" placeholder="C.I" name="ci"/>
								
							</div>
							<div>
								<label>D.O.I:</label>
								<input type="date" placeholder="Date of issue" name="doi"/>
								
							</div>
							<div>
								<label>Some discription:</label>
								<textarea type="input" placeholder="Other info" name="other"rows="5" cols="35"></textarea>
								
							</div>
						</div>
						<div class="bottom">
							
							<input type="submit" value="submit it.." />
							<div class="clear"></div>
						</div>
					</form>
					
				</div>
				<div class="clear"></div>
			</div>
			
		</div>
	
		</body>
</html>