<?php
$flag=0;
?>
<?php
if(isset($_POST['login']))
{
require_once('./dbconnect.php');
session_start(); 
$username = $_POST['username']; 
$password = $_POST['password']; 
$_SESSION["username"] = $username;
$flag=0;
$emailid=$_POST['username'];
$password=$_POST['password'];
$sql="SELECT * from charging_user where emailid='$username' and password='$password' and type='vendor'";
$result = mysql_query($sql) or die(mysql_error());
$numrows = mysql_num_rows($result);
if($numrows ==1)
   {
while ($row = mysql_fetch_array ($result)){
$flag=1;
if($row["type"]=="vendor")
header("./vendordashboard.php");
}
   }
else
   {
    $flag =2;
   }
}
else if(isset($_POST['signup']))
{
	header("./signup.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.ico">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
	<link href="bootswatch/paper/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron-narrow.css" rel="stylesheet">

	<!-- Custom styles for SmartPark -->
    <link href="css/style.css" rel="stylesheet">
	
	<!-- beautiful fonts -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,300" rel="stylesheet" type="text/css">
	
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
		   <li role="presentation" class="active"><a href="login.php">Login</a></li>
            <li role="presentation"><a href="about.php">About</a></li>
            <li role="presentation"><a href="contact.php">Contact</a></li>
          </ul>
        </nav>
       <h3 class="page-header">Go Charge</h3>
      </div>
      <div class="jumbotron">
		<h3 class="welcome-text">GoCharge Login</h3>
        <!-- <h1>Welcome to SmartPark! <br/>Please login to continue.</h1> -->
        <!-- <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p> -->
        <!-- <p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p> -->
		<div class="login-form">
		  <form  action ="" method="post" target="">
		  <p>
		  <?php if($flag==2)
		  {?>
			<p>Invalid username / password</p>
		  <?php
		  }?>
			<div class="form-group">
			  <label class="control-label" for="inputDefault" >Email ID</label>
			  <input type="text" class="form-control" name="username">
			</div>
			<div class="form-group">
			  <label class="control-label" for="inputDefault" >Password</label>
			  <input type="password" class="form-control" name="password">
			</div>
			<div class="form-group">
			 	<p><button class="btn btn-lg btn-success" type="submit" name="login" style="margin-right:10px">Login</button><button style="margin-left:10px" class="btn btn-lg btn-success" action="signup.php" type="submit" name="signup">Sign Up</button></p>
			</div>
		  </p>
		  
		</div>
		</form>
      </div>

      <footer class="footer">
        <p>&copy; GoCharge 2016</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
