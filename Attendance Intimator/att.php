<?php
session_start();
if(!isset($_SESSION['name'])){
header('Location: index.php');
}

?>

<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script >

cse_sub=new Array("STM","DS");
it_sub=new Array("SE","HTML");
ece_sub=new Array("EDC","NT");
civil_sub=new Array("MS","ED");
mech_sub=new Array("ED","MEC");
eie_sub=new Array("EDC","INS");
eee_sub=new Array("NT","EDC");

populateSelect();

$(function(){
      $('#branch').change(function(){
        populateSelect();
    });
});
function populateSelect(){
    branch=$('#branch').val();
	$('#subject').html('');
	if(branch=='CSE'){
	    cse_sub.forEach(function(t) { 
            $('#subject').append('<option>'+t+'</option>');
        });
    }
    
    if(branch=='IT'){
        it_sub.forEach(function(t) {
            $('#subject').append('<option>'+t+'</option>');
        });
    }
	if(branch=='ECE'){
        ece_sub.forEach(function(t) {
            $('#subject').append('<option>'+t+'</option>');
        });
    }
	if(branch=='EEE'){
        eee_sub.forEach(function(t) {
            $('#subject').append('<option>'+t+'</option>');
        });
    }
	if(branch=='EIE'){
        eie_sub.forEach(function(t) {
            $('#subject').append('<option>'+t+'</option>');
        });
    }
	
	if(branch=='MECH'){
        mech_sub.forEach(function(t) {
            $('#subject').append('<option>'+t+'</option>');
        });
    }
	
	if(branch=='CIVIL'){
        civil_sub.forEach(function(t) {
            $('#subject').append('<option>'+t+'</option>');
        });
    }  
} 

</script>
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
<?php

include('topmenu.php');
?>
<div class="wrapper">
	
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">
					<form class="register active" action="atten.php" method="POST" enctype="multipart/form-data">
						<h3>Attendance Report</h3>
						<div class="column" style="margin-left:20%;">
							<div>
													<script>
	$(document).ready(function(){
	$("#yy").click(function(){
	$("#branch").show();
	});
	});
		</script>
								<label>Year:</label>
								<select id="yy" type="input" name="year" required >
   <option value="">Choose year</option>
   <option>1</option>
   <option>2</option>
   <option>3</option>
   <option>4</option>
  
  
   </select>
   							<label>Semester:</label>
								<select id="yy"type="input" name="sem" required>
   <option value="">Choose Semester</option>
   <option>1</option>
   <option>2</option>

  
  
   </select>
   
   <label>Branch:</label>
   								<select id="branch"type="input" name="branch" STYLE="" required>
   <option value="">Choose branch</option>
   <option>CSE</option>
   <option>ECE</option>
   <option>EEE</option>
   <option>MECH</option>
   <option>CIVIL</option>
   <option>EIE</option>
   <option>IT</option>
  
  
   </select>
  
							<div>
								<label>Section :</label>
															<select id="section"type="input" name="section" STYLE="" required>
   <option value="">Section</option>
   <option>A</option>
   <option>B</option>
   <option>C</option>

  
  
   </select>
							</div>		
								
							</div>
							<div>
								<label>Period :</label>
															<select id="period"type="input" name="period" STYLE="" required>
   <option value="">Choose Period</option>
   <option>1</option>
   <option>2</option>
   <option>3</option>
   <option>4</option>
   <option>5</option>
   <option>6</option>
   <option>7</option>
   <option>8</option>
  
  
   </select>
							</div>
							<div>
								<label>Subject :</label>
								<select id="subject" type="input" placeholder="Subject" name="subj" STYLE="" required>
								<option value="">Choose Subject</option>
								</select>
								
							</div>
							<div>
								<label>Date :</label>
								<input type="date"  name="date" required>
								
							</div>
							<div>
								<label>Attendance :</label>
								<textarea type="input" placeholder="Absentees" name="atte" required></textarea>
								
							</div>
							
							<input type="submit" >
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