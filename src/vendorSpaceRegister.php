<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzloJtoo1HH766PCHEDoU66HMxEE_TW6k&callback=initMap"></script>
  <script src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&key=AIzaSyDzloJtoo1HH766PCHEDoU66HMxEE_TW6k" async="" defer="defer" type="text/javascript"></script> 
<script src='https://maps.googleapis.com/maps/api/js?key=&sensor=false&extension=.js'></script> 
<script src="http://maps.googleapis.com/maps/api/js?key=BIzaSyA1gvGcwg6OPMaLsSutIecjkIXrABV3AoF"></script>


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
  </head>

  <body>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="vendordashboard.php">Home</a></li>
			<li role="presentation" class="active"><a href="vendorSpaceRegister.php">Vendor Register</a></li>
            <li role="presentation"><a href="about_vendor.php">About</a></li>
            <li role="presentation"><a href="Contact_vendor.php">Contact</a></li>
			<li role="presentation"><a href="logout.php">Logout</a></li>
          </ul>
        </nav>
        <h3 class="page-header">Go Charge</h3>
      </div>
      <div class="jumbotron">
		<h3 class="welcome-text">Vendor Charging Station Registration</h3>
		<div class="register-form">
		  <form action="vendorRegisterComplete.php" method="post">
		  <p>
			<div class="form-group">
			  <label class="control-label" for="inputDefault" >Charging Station Name</label>
			  <input type="text" class="form-control" name="parkingname" required></input>
			</div>
			<div class="form-group">
			  <label class="control-label" for="inputDefault" >Charging Station Area</label>
			  <input type="text" class="form-control" name="areaname" id="areanameid" required></input>
			</div>
			<div class="form-group">
			 <input type="hidden" id="lat" name="lat" class="form-control" required></input>
			<input  type="hidden" id="lng" name="lng" class="form-control" required></input>
			</div>
			<div class="form-group">
			 <label class="control-label" for="inputDefault" >Number of Slots</label>
			 <input type="number" name="numberofslots" class="form-control" min="1" max="100" required></input>
			</div>
				 <div class="form-group">
				   <label class="control-label" for="inputDefault" >Slot naming convention <br> (If PA1-PA50 insert PA)</label>
				   <input type="text" name="slotname" class="form-control" required></input>
				 </div>
				 <div class="form-group">
				   <label class="control-label" for="inputDefault" >Price per hour</label>
				   <input type="number" name="pricePerHour" class="form-control" min="1" max="1000" required></input>
				 </div>
				<div class="form-group">
					   <p><button class="btn btn-lg btn-default" type="reset" name="Reset">Reset</button>
					   <form action="vendor_dashboard.php" class="inline">
				<button class="btn btn-lg btn-success" type="submit" name="register">Register</button></p>
				</form>
			</div>
		  </p>
		  
		</div>
		</form>
      </div>
	 

      <footer class="footer">
        <p>&copy;Go Charge 2016</p>
      </footer>

    </div> <!-- /container -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
	<script async>
		var autocomplete = new google.maps.places.Autocomplete((document.getElementById('areanameid')));
		      //autocomplete.bindTo('bounds', $scope.map);
		       autocomplete.addListener('place_changed', function() {			    
			    var place = autocomplete.getPlace();
			    if (!place.geometry) {
			    	//$('#addLifeEventModal').modal('show');
			      	alert("Address entered is not valid, please enter again");
			    } else {			 
            var geocoder = new google.maps.Geocoder();
               geocoder.geocode( { 'address': place.formatted_address},  function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var destination1 = {
                          lat:results[0].geometry.location.lat(),
                          lng:results[0].geometry.location.lng()
                        };
                        document.getElementById('lat').value =  destination1.lat;     
                        document.getElementById('lng').value =  destination1.lng; 
                      } else {
                      alert("Invalid destination address, please enter again");
                    }
                  });
                
				  	alert(place.formatted_address);
			    	//$scope.correctDestinationAddress = place;
			    }
    });


	</script>
  </body>
</html>
