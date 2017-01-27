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
$type=$_POST['type'];
$sql="SELECT * from charging_user where emailid='$username' and password='$password' and type='$type'";
$result = mysql_query($sql) or die(mysql_error());
$numrows = mysql_num_rows($result);
if($numrows ==1)
   {
while ($row = mysql_fetch_array ($result)){
$flag=1;
if($row["type"]=="user")
header("Location:./udashboard.php");
if($row["type"]=="vendor")
header("Location:./vendordashboard.php");
if($row["type"]=="admin")
header("Location:./admin.php");	
}
   }
else
   {
    $flag =2;
   }
}
else if(isset($_POST['signup']))
{
	header("Location:./signup.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.ico">

    <title>Login</title>
	<link href="bootswatch/paper/bootstrap.min.css" rel="stylesheet">
    <link href="css/jumbotron-narrow.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,300" rel="stylesheet" type="text/css">
    <script src="js/ie-emulation-modes-warning.js"></script>
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
		<h3 class="welcome-text">Go Charge Login</h3>
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
			 <label class="control-label" for="inputDefault" >User Type</label>
				<select id="dropdown" class="form-control" name="type">     
					<option selected>Select type</option>     
					<option value="user" >User</option>     
					<option value="vendor">Vendor</option>
                    <option value="admin">Admin</option>     
				</select>					
				</select>
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

    </div>
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
