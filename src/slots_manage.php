
<?php
	require_once('./dbconnect.php');
	$charging_station_id = $_GET['locationid'];
	$query = "SELECT slot_id FROM slot WHERE charging_station_id ='$charging_station_id'";
	$result = mysql_query($query) or die(mysql_error());
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
				  <form>
				 
				  <?php 
				  $data= "Slot";
				  $flag=0;
				  $var="delete";
				  
			   for($i=0; $i<count($slotData);$i++) {
				echo '</tr>';
				echo '<tr style="margin-bottom:10px">';				
				echo '<td style="margin-right:15px">
			<button type="submit" name="submit" class="btn btn-default btn btn-xs btn-success pull-right" style="margin-right:10px; margin-bottom:20px" > '.$data.''.$slotData[$i]['slot_id'].'</button></td>';
			echo '<td style="margin-right:15px"><a href="./success.php?slotid='.$slotData[$i]['slot_id'].'"><button type="submit1" name="slotid"  class="btn btn-default btn btn-xs btn-success pull-right" style="margin-right:10px; margin-bottom:20px" >Manage</a></button></td>';
		
			   }			   
				?>
				</table>
				</form>
			</div>
		</body>
		</html>
		
