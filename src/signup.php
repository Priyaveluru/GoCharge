<?php
$flag=0;
?>
<?php
if(isset($_POST['signup']))
{
require_once('./dbconnect.php');
session_start(); 
$username = $_POST['username']; 
$email = $_POST['email'];
$password = $_POST['password']; 
$category = $_POST['category'];
$vendor = $_POST['vendor'];
$t=date("Y-m-d");
print $t;
$sql="INSERT INTO charging_user (name,emailid,password,category,type,timestamp) VALUES ('$username','$email','$password','$category','$vendor','$t')";
if(mysql_query($sql)) 
{
	 header("Location:./login.php");
}
	
else
{
	die(mysql_error());
}

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

    <title>Narrow Jumbotron Template for Bootstrap</title>
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
            <li role="presentation" class="active"><a href="login.php">Home</a></li>
            <li role="presentation"><a href="about.php">About</a></li>
            <li role="presentation"><a href="contact.php">Contact</a></li>
          </ul>
        </nav>
        <h3 class="page-header">Go Charge</h3>
      </div>
      <div class="jumbotron">
		<h3 class="welcome-text">Sign Up</h3>
		<div class="login-form">
		  <form action="" method="post">
		  <p>
			<div class="form-group">
			  <label class="control-label" for="inputDefault" >Name</label>
			  <input type="text" class="form-control" name="username" required>
			</div>
			<div class="form-group">
			  <label class="control-label" for="inputDefault" >User ID / Email</label>
			  <input type="text" class="form-control" name="email" required>
			</div>
			<div class="form-group">
			  <label class="control-label" for="inputDefault" >Password</label>
			  <input type="password" class="form-control" name="password" required>
			</div>
			<div class="form-group">
			  <label class="control-label" for="inputDefault" >Category</label>
			  <input type="text" class="form-control" name="category" required>
			</div>
			<div class="form-group">
			 <label class="control-label" for="inputDefault" >Type</label>
				<select id="dropdown" class="form-control" name="vendor">     
					<option selected>Select item</option>     
					<option value="user" >User</option>     
					<option value="vendor">Vendor</option>
                    <option value="admin">Admin</option>     
				</select>					
				</select>
			</div>
			<div class="form-group">
			 	<p><button class="btn btn-lg btn-success" type="submit" name="signup">Sign Up</button></p>
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
