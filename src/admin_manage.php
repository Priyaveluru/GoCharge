<?php 
	require_once('./dbconnect.php');
	session_start();
	$username = $_SESSION["username"];
	$location_id = $_GET['locationid'];
	//echo $location_id;
	
	$sql = "select charging_station_name, charging_station_desc from charging_station where charging_station_id=".$location_id;	
	$result = mysql_query($sql) or die(mysql_error());
		
		$locationData = mysql_fetch_assoc($result);	

	$query2 = "select slot_id from slot where charging_station_id=".$location_id." and is_free=0 limit 15;";
	$result = mysql_query($query2) or die(mysql_error());
		$slotData = array();
		while ($row = mysql_fetch_assoc($result)) 
		{
			array_push($slotData, $row);
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

    <title>Go Charge</title>

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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	</head>

  <body>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="login.php">Home</a></li>
			
			 
            <li role="presentation"><a href="about.php">About</a></li>
            <li role="presentation"><a href="contact.php">Contact</a></li>
			<li role="presentation"><a href="logout.php">Logout</a></li>
          </ul>
        </nav>
        <h3 class="page-header">GoCharge</h3>
      </div>
      <div class="jumbotron">
		<div style="border:1px solid;margin-bottom:20px;">
			<h6 style="text-align:left;margin-left:5px;"><span style="color:orange;" >Name: </span><?= $locationData['charging_station_name'] ?></h6>
			<h6 style="text-align:left;margin-left:5px;"><span style="color:orange;" >Address: </span> <?= $locationData['charging_station_desc'] ?></h6>
		</div>
		<form name="myform" method="post">
			<div class="" style="float:left;color:black;background-color: #77b300;border-color: #77b300;padding: 1px 5px;font-size: 14px;  width:40%;line-height: 2.5;border-radius: 3px;text-align:left;">Select Duration
				<select  id ="duration" name="duration"class="duration" onChange="disp_text()">
				  <option value="5$">1hour</option>
				  <option value="10$">2hours</option>
				  <option value="15$">3hours</option>
				  <option value="20$">4hours</option>
				</select>
			</div>
			<div style="float:left; margin-left:5%;width:35%;height:35px;text-align:left;padding:10px;padding-top:5px;" id="display" class="alert alert-warning">
				You will be charged : 
			</div>
        </form>
		
			<div style="margin-top:20px;">
			<table style="border:1px solid;" border='1' width='40%'>
			<th style="padding:15px"> Slot #</th>
			<th style="padding:15px;">  </th>
			<?php	
                
				for($i=0; $i<count($slotData);$i++) {
				echo '<tr>';									
				echo '<td style="padding:20px;">'.$slotData[$i]['slot_id'].'</td>';
				echo '<td style="padding:20px;"><button type="submit"id="book_slot"  data-slot='.$slotData[$i]['slot_id'].' name="submit" class="btn btn-default btn btn-xs btn-success pull-right" style="float:left;">Book Slot</button></td>';
			  }
			?>
			</table>
			</div>
		 </div>
		 <footer class="footer">
        <p>&copy;GoCharge 2016</p>
      </footer>
    </div> 
   
  </body>
</html>
	 <script >
			  function disp_text()
			   {
			     document.getElementById('display').innerHTML = document.getElementById("duration").value;
				
				  
			   }
			</script>
<script>
$(document).ready(function(){
    $('#book_slot').click(function(){
		var slotId = $(this).attr('data-slot');
		localStorage.setItem("cost", "duration");
         var duration = document.getElementById('duration').value;
          var url = './bookingPage.php?slotId=' + slotId + '&duration=' + duration;
       /* $.post(ajaxurl, data, function (response) {
            alert(duration);
        });*/
		window.location.href = url;
    });

});
</script>
