
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
			<script src="js/dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="js/dist/sweetalert.css">

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
					<li role="presentation" class="active"><a href="udashboard.php">User Dashboard</a></li>
					<li role="presentation" class=""><a href="about.php">About</a></li>
					<li role="presentation"><a href="contact.php">Contact</a></li>
					<li role="presentation"><a href="logout.php">Logout</a></li>
				</ul>
			</nav>
				<h3 class="page-header">Go Charge</h3>
		</div>
			<div class="jumbotron row" style="margin-top:-10px;">
				<h3 class="welcome-text" style="margin-top:-30px;">User Dashboard</h3>
					<div class="form-group" style="">
						<button class="btn btn-lg btn-warning" type="submit" onclick="window.location.href='temp.html'"  name="Current Temperature" style="float:left;margin-left:60px;margin-top: 20px;height: 150px;width: 250px">Current Weather</button>
						<button class="btn btn-lg btn-primary" type="submit" onclick="display_pressure()"  name="Tyre Pressure" style="margin-left: 5px;float: left;height: 150px;margin-top: 20px;width: 250px;">Tyre Pressure</button>
						<button class="btn btn-lg btn-success" type="submit" onclick="display_battery_status()"  name="Battery Status" style="float:left;margin-left:60px;margin-top:5px;height:150px;width:250px">Battery Status</button>
						<button class="btn btn-lg btn-danger" type="submit" onclick="window.location.href='show-area.php'"  name="Find Charge Station" style="margin-left: 5px;float:left;height:150px;margin-top:5px;width:250px;">Find Charging Stations</button>	
					</div>
			</div>
      <footer class="footer">
        <p>&copy; Go Charge 2016</p>
      </footer>

   </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
	<script language="JavaScript" type="text/javascript">
	function display_pressure()
	{
	 tyre_pressure_level = Math.floor(Math.random() * (35 - 32) + 32);
	 swal("Tyre Pressure \n" +tyre_pressure_level+ " \tPSI");
	}
	function display_battery_status()
	{
	 battery_status_level = Math.floor(Math.random() * (25 - 10) + 10);
	 if(battery_status_level >15)
	 {
		swal("Battery Status \n" +battery_status_level+ "%" + "\n" + "Battery Low Find Nearest Charging Station" + "\n Range greater than 10 Miles"); 
	 }
	 else if(battery_status_level < 15)
	 {
	 swal("Battery Status \n" +battery_status_level+" % " + " \n" + "Battery Low Find Nearest Charging Station" + " \n Range less than 10 Miles");
	 }
	}
	</script>
  </body>
</html>
