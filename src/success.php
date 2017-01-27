<?php
require_once('./dbconnect.php');
$value=$_GET['slotid'];
//$sql = "DELETE FROM slot WHERE slot_id ='$value'";
//$result = mysql_query($sql) or die(mysql_error());


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

    <!-- Bootstrap core CSS -->
    <!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
	<link href="bootswatch/paper/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron-narrow.css" rel="stylesheet">

	<!-- Custom styles for SmartPark -->
    <link href="css/style.css" rel="stylesheet">
	
	<!-- beautiful fonts -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,300" rel="stylesheet" type="text/css">
    <script src="js/ie-emulation-modes-warning.js"></script><html>
	</head>
		<body>
		<div class="container">
			  <div class="header clearfix">
				<nav>
				  <ul class="nav nav-pills pull-right">
					<li role="presentation" class="active"><a href="Home.php">Home</a></li>
					<li role="presentation"><a href="about.php">About</a></li>
					<li role="presentation"><a href="contact.php">Contact</a></li>
				  </ul>
				</nav>
				<h3 class="page-header">Go Charge</h3>
			  </div>
				 <div class="jumbotron">
				 <h3><?php echo 'Successfully deleted charging slot'.$value;?></h3>
      
			</div>
		</body>
		</html>
		
