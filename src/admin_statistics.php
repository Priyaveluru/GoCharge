<?php 
				require_once('./dbconnect.php');
				
				$sql = "SELECT charging_station_name, charging_station_id from charging_station";

				//echo $query;
				$result = mysql_query($sql) or die(mysql_error());
				$resultData = array();
				while ($row = mysql_fetch_assoc($result)) 
				{
					array_push($resultData, $row);
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
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="/highcharts.js"></script>
	<script src="/exporting.js"></script>
    <script type="text/javascript">
    $(document).ready(
  
  /* This is the function that will get executed after the DOM is fully loaded */
  function () {
    $( "#datepicker" ).datepicker({
      changeMonth: true,//this option for allowing user to select month
      changeYear: true //this option for allowing user to select from year range
    });
    $( "#datepicker2" ).datepicker({
      changeMonth: true,//this option for allowing user to select month
      changeYear: true //this option for allowing user to select from year range
    });
  }

);
    </script>

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
	
  </head>

  <body>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="home.php">Home</a></li>
            <li role="presentation"><a href="about.php">About</a></li>
            <li role="presentation"><a href="contact.php">Contact</a></li>
          </ul>
        </nav>
        <h3 class="page-header">Go Charge</h3>
      </div>

      <div class="jumbotron">
        <h3>Choose the Statistics to view</h3>
		<div class="register-form">
        <form method="POST" action="u_statistics.php" id="checkStats" validate>
			<table>
				<div class="form-group">
				  <label class="control-label" for="inputDefault" >Start Date</label>
				  <input type="text" class="form-control" name="startDate" id="datepicker" form="checkStats" required></input>
				</div>
				<div class="form-group">
				  <label class="control-label" for="inputDefault" >End Date</label>
				  <input type="text" class="form-control" name="endDate" id="datepicker2" form="checkStats" required></input>
				</div>
				
				<div class="form-group">
				  <label class="control-label" for="inputDefault" >Location</label>

				
						<select name="locationid" style="margin-bottom:2px; " class="form-control" form="checkStats">
		                    <option value="-1">All</option>
		                    <?php for( $i=0; $i<count($resultData);$i++) {
		                    	echo '<option value="'.$resultData[$i]['charging_station_id'].'">'.$resultData[$i]['charging_station_name'];
		                    	echo '</option>';
		                    }
		                    ?>               
		                  </select>
				</div>
				<div class="form-group">
				  <label class="control-label" for="inputDefault" >Units</label>

						<select name="units" style="margin-bottom:2px; " class="form-control" form="checkStats">
		                    <option value="date">Daily</option>
		                    <option value="week">Weekly</option>
		                    <option value="month">Monthly</option>                 
		                    <option value="year">Yearly</option>                 
		                  </select>
					</div>
					
				<div class="form-group">
			 	<button class="btn btn-lg btn-success" type="submit" name="submit" style="margin-right:10px">Check Statistics</button>
				</div>
				
		</form>
		<div class="register-form">
      </div>

      <footer class="footer">
        <p>&copy; Go Charge 2016</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
