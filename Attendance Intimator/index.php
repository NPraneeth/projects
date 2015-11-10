<html>
  <head>
  <title>Online Processing system of students</title>
    <link rel="stylesheet" type="text/css" href="indexstyles.css">
	<style>
body
{
	background:#303030;
	background:rgba(0,0,0,.5);
	z-index:0;
	height:100%;
	width:100%;
	position:absolute;
	top:0;
	left:0;
	}
	</style>
  </head>
<body style="background:url('stuff.jpg');
background-size:cover;background-repeat:no-repeat;overflow:hidden;
">

<a href="parent.php" style="display:block;padding:20px;background:#F8F8F8;color:gray;float:right;margin:0;z-index:;">Parent Login</a>

    <div class="mywrap">
	<span id="mylogo" style="z-index:1000;color:white;font-family:calibri;font-size:2.5em;">Online Processing system of students</span>
      <div id="box">
        <img src="http://www.pixentral.com/pics/1A2fMA1TzhR2QtSPBE7jHWv9k.png" alt="lock" />
        <h3>Please sign in</h3>
        <form action="login.php" method="POST">
          <input type="text" placeholder="USERNAME" name="uname"/>
          <input type="password" placeholder="PASSWORD" name="pass"/>
        <br>
        <br> <center>
         <input onclick="this.style.backgroundColor = '#69c061';" id="sig" type="submit" value="go on... click me!"/>
		 <span style="color:red;font-family:tahoma;"><?php session_start();  error_reporting(0);  echo $_SESSION['emp']; session_destroy();?></span>
		 </center>
        </form>
        <div class="signup">
          <p><a href="#">forgot password?</a></p>
        </div>
		
      </div>
    </div>
  </body>
</html>