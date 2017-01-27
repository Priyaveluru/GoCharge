<?php
	require_once('./dbconnect.php');
	 session_start();
     $cost=$_GET['duration'];
		$flag=0;
	$slot_id = $_GET['slotId'];
	$username = $_SESSION["username"];
	$sql="SELECT charging_station_id from slot where slot_id='$slot_id'";
	$result = mysql_query($sql) or die(mysql_error());
	$charging_id = mysql_fetch_assoc($result)["charging_station_id"];

	$t=date("Y-m-d");
				$sql="SELECT user_id from charging_user where emailid='$username'";
				$result = mysql_query($sql) or die(mysql_error());
				$user_id = mysql_fetch_assoc($result)["user_id"];
				$sql ="SELECT category FROM charging_user where user_id='$user_id'";
				$result = mysql_query($sql) or die(mysql_error());
				$category = mysql_fetch_assoc($result)["category"];
				$sql ="SELECT slot_id FROM slot where user_id='$user_id'";
				$result = mysql_query($sql) or die(mysql_error());
				$sql="INSERT INTO pricing(charging_station_id,category,cost,day_of_week,slot_id) VALUES ('$charging_id','$category','$cost','$t','$slot_id')";
				$result = mysql_query($sql) or die(mysql_error());
				echo '</tr>';
		
	$sql="SELECT * from charging_station where charging_station_id='$charging_id'";
	$result = mysql_query($sql) or die(mysql_error());
	
	while ($row = mysql_fetch_array ($result))
	{
	$charging_station_name = $row["charging_station_name"];
	$charging_station_desc = $row["charging_station_desc"];
	}
	
	//echo $parking_space_name;
	//echo $parking_space_desc;
	$sql="SELECT user_id from charging_user where emailid='$username'";
	$result = mysql_query($sql) or die(mysql_error());
	//echo $slot_id;
	//echo $username;
	$user_id = mysql_fetch_assoc($result)["user_id"];
	$result = mysql_query($sql) or die(mysql_error());
?>
<?php

	if(isset($_POST['bill']))
	{
		 $cost=$_GET['duration'];

		 if($cost)
		 {
		
		$flag=1;
		 }
		else
		{
			$flag=2;
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
            <li role="presentation"><a href="udashboard.php">Home</a></li>
			<li role="presentation" class="active"><a href="bookingPage.php">Billing</a></li>
            <li role="presentation"><a href="about.php">About</a></li>
            <li role="presentation"><a href="contact.php">Contact</a></li>
			<li role="presentation"><a href="logout.php">Logout</a></li>
          </ul>
        </nav>
        <h3 class="page-header">Go Charge</h3>
      </div>

      <div class="jumbotron">
        <h3>Your booking details are as follows</h3>
        
      

      <div class="row marketing">
        
          <h4> </h4>
		  <?php
			echo '<h4>Slot Number : '.$slot_id." </br>Charging Station : ".$charging_station_name." </br>Area : ".$charging_station_desc.'</h4>';
		  ?>
		  <form action="" method="post">
		  <div class="form-group">
			 	<p><button class="btn btn-lg btn-success" type="submit" name="bill" style="margin-right:10px">Bill Details</button>		
		</div>
		</form>
		<?php
		if($flag==1)
		{
			echo "<h5><p>You have been charged ".$cost." dollars</p><h5>";?>
			<form action="https://www.paypal.com/signin?returnUri=http%3A%2F%2Furi.paypal.com%2FWeb%2FWeb%2Fcgi-bin%2Fwebscr%3Fvia%3Dul&state=%3fcmd%3d_account">
            <input type="submit" class="btn btn-s btn-primary" value="Pay Now"/>
            </form>
		<?php }
		
		if($flag==2)
		{
			echo '<p>No bill has been generated yet</p>';
		}
		?>
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
