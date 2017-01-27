<?php
require_once('./dbconnect.php');
   // $charging_station_id = $_GET['locationid'];
		
		$query = "SELECT Sensor_id,Sensor_name,Charging_station_id,location,status from sensor";
		$result = mysql_query($query) or die(mysql_error());
		$sensorData = array();
		while ($row = mysql_fetch_assoc($result)) 
		{
			array_push($sensorData, $row);
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
					<li role="presentation"><a href="admin.php">Home</a></li>
					<li role="presentation" class="active"><a href="charging_stations.php">Manage Sensors</a></li>
					<!--<li role="presentation"><a href="about.php">About</a></li>-->
                      <li role="presentation"><a href="logout.php">Logout</a></li>
				  </ul>
				</nav>
				<h3 class="page-header">Go Charge</h3>
			  </div>
				 <div class="jumbotron">
				
				 <div style="margin-top:20px;">
					<table style="border:1px solid;" border='1' width='100%'>
					<th style="padding:15px"> Sensor id </th>
					<th style="padding:15px;">Sensor Name  </th>
					<th style="padding:15px;">Charging Station Id</th>
					<th style="padding:15px;">Location </th>
					<th style="padding:15px;">Status </th>
					<th style="padding:25px;text-align:center">Action</th>
				 
					 <h2></h2>
					 <?php
	            for($i=0; $i<count($sensorData);$i++) {
				echo '<tr>';
				echo '<td style="padding:10px">'.$sensorData[$i]['Sensor_id'].'</td>';
				echo '<td style="padding:10px">'.$sensorData[$i]['Sensor_name'].'</td>';
				echo '<td style="padding:10px">'.$sensorData[$i]['Charging_station_id'].'</td>';
				echo '<td style="padding:10px">'.$sensorData[$i]['location'].'</td>';
				echo '<td style="padding:10px">'.$sensorData[$i]['status'].'</td>';
				echo '<td style="">
						<button   id="edit_CStation" onclick="editStation(this)" data-stationStatus='.$sensorData[$i]['status'].' data-stationName="'.$sensorData[$i]['Sensor_name'].'"   data-station="'.$sensorData[$i]['Charging_station_id'].'"  class="btn btn-default btn btn-sm btn-primary " style="">Edit</button>
						<button  id="delete_CStation" onclick="deleteStation(this)"  data-station="'.$sensorData[$i]['Sensor_id'].'"  class="btn btn-default btn btn-sm btn-danger " style="">Delete</button>
					  </td>';
				echo '</tr>';
				}
				?>
				</table>
		</div>
		 <div class="modal fade" id="editStationModal" tabindex="-1" role="dialog" aria-labelledby="view" aria-hidden="true">
			 <div class="modal-dialog modal-lg" style="width:60%">
				 <div class="modal-content">
					 <div class="modal-header">
						 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-close" aria-hidden="true"></span></button>
						 <h4 class="modal-title custom_align" id="Heading">&nbsp;&nbsp;Update Sensor</h4>
					 </div>
					 <div class="modal-body">
						 <form id="addStationForm" name="editStationForm" class="form-horizontal">
							 <div id='editStationModal-content'  style="margin-left:5px;">
								 <input type="hidden"  id="editStation-id" value=""/>
								 <div class="row">
									 <div class="col-md-6" >
										 <label for="editStation-name">Sensor Name</label>
										 <input type="text" required class= "form-control"  style="color:#000" name="editStationName" id="editStation-name" />
									 </div>
									 <div class="col-md-6">
										 <label for="editStation-status">Status</label>
										 <select name="editStationStatus" id="editStation-status" required class= "form-control" style="color:#000">
											 <option value="Available" >Available</option>
											 <option value="Inactive" >In Active</option>
										 </select>
									 </div>
								 </div>

							 </div>
						 </form>
					 </div> 	 <!-- End of Modal Body-->
					 <div class="modal-footer ">
						 <button id="station-edit"	 name="editStation" class="btn btn-success btn-sm" onclick="updateStation(this)"  ><i class="fa fa-check-circle"></i>&nbsp;Update Sensor</button>
						 <button class="btn btn-primary btn-sm" data-dismiss="modal" id="close" ><i class="fa fa-times-circle"></i>&nbsp;Close</button>
					 </div>

				 </div> <!-- /.modal-content -->
			 </div> <!-- /.modal-dialog -->
		 </div> <!-- /.modal-fade -->
		 
		 <script>
		 function editStation(element) {
			document.getElementById("addStationForm").reset();
			 $('#editStation-id').val(element.getAttribute('data-station'));
			 $('#editStation-name').val(element.getAttribute('data-stationName'));
			 $('#editStation-status').val(element.getAttribute('data-stationStatus'));
			 $('#editStationModal').modal('show');
		 }
		 function deleteStation(element) {
			 $('#editStation-id').val(element.getAttribute('data-station'));
			 var cStationId = $('#editStation-id').val();
			 var confirmValue = confirm('Sure you want to delete ? ');
			 if(confirmValue) {
				 $.ajax({
					 url: "deleteStation.php",
					 type: "POST",
					 data: {
						 cStationId: cStationId
					 },
					 dataType: "JSON",
					 success: function (jsonStr) {
						alert(JSON.stringify(jsonStr));
						 alert('Deleted Successfully !!');
						 location.reload(true);
					 },
					 error: function (err) {
						 alert('Error While Deleting !!' + JSON.stringify(err));
					 }
				 });
			 }
		 }
		 function updateStation(){
			var cStationId = $('#editStation-id').val();
			var cStationName =   $('#editStation-name').val();
			 var cStationStatus =   $('#editStation-status').val();

			 $.ajax({
				 url: "UpdateSensor.php",
				 type: "POST",
				 data: {
					 cStationId: cStationId,
					 cStationName:cStationName,
					 cStationStatus: cStationStatus
				 },
				 dataType: "JSON",
				 success: function (jsonStr) {
					 // alert(JSON.stringify(jsonStr));
					 location.reload(true);
					 $('#editStationModal').modal('hide');
				 },
				 error: function () {
					 $('#editStationModal').modal('hide');
				 }
			 });
		}
		 </script>
		 <script src="js/circlestats/jquery-1.9.1.min.js"></script>
		 <script src="js/circlestats/jquery-migrate-1.0.0.min.js"></script>

		 <script src="js/circlestats/jquery-ui-1.10.0.custom.min.js"></script>

		 <script src="js/circlestats/jquery.ui.touch-punch.js"></script>

		 <script src="js/circlestats/modernizr.js"></script>

		 <script src="js/circlestats/bootstrap.min.js"></script>
		</div> 
	 <footer class="footer">
        <p>&copy; Go Charge 2016</p>
      </footer>

</body>

</html>
