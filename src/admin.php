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
    <script src="js/ie-emulation-modes-warning.js"></script>
		<body>
		<div class="container">
			  <div class="header clearfix">
				<nav>
				  <ul class="nav nav-pills pull-right">
					<!--<li role="presentation" class="active"><a href="Home.php">Home</a></li>
					<li role="presentation"><a href="about.php">About</a></li>-->
					<li role="presentation" class="active"><a href="admin.php">Admin Dashboard</a></li>
					<li role="presentation"><a href="manage_sensors.php">Manage sensors</a></li>
					<li role="presentation"><a href="logout.php">logout</a></li>
				  </ul>
				</nav>
				<h3 class="page-header">Go Charge</h3>
			  </div>
					 <h2></h2>
				<div class="jumbotron row" style="margin-top:-10px;">
				<h3 class="welcome-text" style="margin-top:-30px;">Admin Dashboard</h3>
					<div class="form-group" style="">
						<button class="btn btn-lg btn-danger" type="submit" onclick="window.location.href='charging_stations.php'" style="float:left;margin-left:60px;margin-top: 20px;height: 150px;width: 250px">Manage Charging Stations</button>
						<button class="btn btn-lg btn-success" type="submit" onclick="window.location.href='vendorstats.php'"  name="Vendor Stats" style="margin-left: 5px;float: left;height: 150px;margin-top: 20px;width: 250px;">Vendor Statistics</button>
						<button class="btn btn-lg btn-primary" type="submit" onclick="window.location.href='userstats.php'"  name="User Stats" style="float:left;margin-left:60px;margin-top:5px;height:150px;width:250px">User Statistics</button>
						<button class="btn btn-lg btn-warning" type="submit" onclick="window.location.href='revenuestats.php'" name="Revenue Stats" style="margin-left: 5px;float:left;height:150px;margin-top:5px;width:250px;">Revenue Statistics</button>
					</div>
			</div>
			<footer class="footer">
        <p>&copy; GoCharge 2016</p>
      </footer>
				  
		</body>
		</html>
