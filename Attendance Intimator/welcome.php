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

 <link rel="stylesheet" type="text/css" href="wel.css">
</head>
<body style="background:url('hh.jpg');
background-size:cover;background-repeat:no-repeat;
">
<?php

include('topmenu.php');
?>
<br><br>
<b>
<span style="color:green;font-size:1.3em;margin-left:50px;">INTRODUCTION</span></b><br>
<p style="width:1000px;font-size:1.2em;font-family:calibri;text-indent:20px;line-height:30px;text-align:justify;margin-left:30px;">
Student Management System deals with all kind of student details, academic related reports, college details, course details, curriculum, batch details and other resource related details too. It tracks all the details of a student from the day one to the end of his course which can be used for all reporting purpose, tracking of attendance, progress in the course, completed semesters years, coming semester year curriculum details, exam details, project or any other assignment details, final exam result; and all these will be available for future references too.
Our program will have the databases of Courses offered by the college with student's attendance details
can be generated based of vast options related to students, batch, course,semester given by the teacher / faculty and also maintain the complaint box for the students .
</p>
<b><span style="color:green;font-size:1.3em;margin-left:50px;">About the project</span></b><br>
<p style="font-size:1.2em;font-family:calibri;text-indent:20px;line-height:30px;text-align:justify;margin-left:30px;padding:10px;">
The student management system is an automated version of manual Student Management System. It can handle all details about a student. The details include branch details,semester details, subject details etc...
In case of manual system they need a lot of time, manpower etc.Here almost all work is computerized. So the accuracy is maintained. Maintaining backup is very easy. It can do with in a few minutes. Our system has two type of accessing modes i.e.,administrator and user. Student management system is managed by an administrator. It is the job of the administrator to insert update and monitor the whole process. When a user log in to the system. He would only view details of the student. He can't perform any changes.As The system has three modules.

</p>
</body>
</html>