<?php
require_once('./dbconnect.php');
session_start();
$username = $_SESSION["username"];
$sql = "SELECT NAME FROM charging_user WHERE emailid='$username'";
$result = mysql_query($sql) or die(mysql_error());
$user = mysql_fetch_assoc($result)["NAME"];
$sql = "SELECT c.latitude,c.longitude,c.charging_station_id,c.charging_station_name,c.charging_station_desc,is_deleted,COUNT(s.charging_station_id) AS total,
(1-IFNULL(AVG(s.is_free),0))*COUNT(s.charging_station_id) AS available FROM slot s
RIGHT JOIN charging_station c ON s.charging_station_id= c.charging_station_id 
WHERE is_deleted='0' GROUP BY c.charging_station_id";     
	$result = mysql_query($sql) or die(mysql_error()); 
    $locationData = array();
    while ($row = mysql_fetch_assoc($result)) 
    {
      array_push($locationData, $row);
    }
   
?>

<!DOCTYPE html>

<html>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.ico">

    <title>Narrow Jumbotron Template for Bootstrap</title>
	<link href="bootswatch/paper/bootstrap.min.css" rel="stylesheet">
    <link href="css/jumbotron-narrow.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,300" rel="stylesheet" type="text/css">
    <script src="js/ie-emulation-modes-warning.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script>
  <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBA2EQqNJrhk-Qtmqf51TWf5P4N5N6VzvY&callback=initMap"></script>
    <script src="http://rawgit.com/allenhwkim/angularjs-google-maps/master/build/scripts/ng-map.min.js"></script>

    <style type="text/css">
      /*CSS for map info-window-Start*/
      #map-canvas {
          margin: 0;
          padding: 0;
          height: 600px;
          max-width: none;
      }
      .gm-style-iw {
          /*width: 350px !important;*/
          top: 10px !important;
          left: 0px !important;
          background-color: #fff;
          box-shadow: 0 1px 6px rgba(178, 178, 178, 0.6);
          border: 1px solid rgba(72, 181, 233, 0.6);
          border-radius: 10px 10px 10px 10px;
      }
      #iw-container {
          margin-bottom: 5px;
	  text-align: left !important; 
      }
      #iw-container .iw-title {
          font-family: 'Open Sans Condensed', sans-serif;
          font-size: 22px;
          font-weight: 400;
          padding: 10px;
          background-color: #48b5e9;
          color: white;
          margin: 0;
          border-radius: 2px 2px 0 0;
      }
      #iw-container .iw-content {
          font-size: 13px;
          line-height: 18px;
          font-weight: 400;
          margin-right: 1px;
          padding: 10px 5px 10px 5px;
          max-height: 200px;
          overflow-y: auto;
          overflow-x: hidden;
      }
      .iw-content img {
          float: right;
          margin: 0 5px 5px 10px; 
      }
      .iw-subTitle {
          font-size: 16px;
          font-weight: 400;
          padding: 0px 0;
      }
      .iw-bottom-gradient {
          position: absolute;
          width: 410px;
          height: 25px;
          bottom: 10px;
          right: 18px;
          background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
          background: -webkit-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
          background: -moz-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
          background: -ms-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
      }
   /*CSS for map info-window-End*/   
    </style>
  </head>
  <body ng-app="userHomepageApp" ng-controller="userHomepageCtrl">
  
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="udashboard.php">Home</a></li>
			<li role="presentation" class="active"><a href="show-area.php">Show Area</a></li>
            <li role="presentation"><a href="about.php">About</a></li>
            <li role="presentation"><a href="contact.php">Contact</a></li>
			<li role="presentation"><a href="logout.php">Logout</a></li>
          </ul>
        </nav>
        <h3 class="page-header">Go Charge</h3>
      </div>
      <div class="jumbotron">
	   <h4 style="margin-top:-31px">Welcome to Go Charge&nbsp<?php print $user?>!</h4>
	  <h4 class="welcome-text">Choose Charging Station</h4>
	<div id="map-canvas" style="border: 9px solid;border-color: #77b300;">
	  <map center="current-position" zoom="10" on-click="addMarker()" ng-model="map"  style="height:100%">
             <marker position="current-position" icon="img/currentLocation.png" title="You are here">
	    </marker>
	    <marker ng-repeat="location in locations" name="{{location}}"
		    position="{{location.latitude}}, {{location.longitude}}" title="{{location.locationname}}" on-click="showParkingData()"></marker>           
          </map>
	</div>
      </div>
      <footer class="footer">
        <p>&copy; GoCharge 2016</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>


  <script type="text/javascript">
    var myApp = angular.module('userHomepageApp', [ 'ngMap' ]);

      myApp.controller('userHomepageCtrl', function($scope, $compile, $http) {
        $scope.setLocations = function() {
          $scope.locations = <?php echo json_encode($locationData); ?>;
        };

        var infowindow = new google.maps.InfoWindow({
            content: "  Selected",
            maxWidth: 500
        });

        $scope.getAvailableSlots = function(locationid) {
          console.log("In getAvailableSlots");
          alert("Will look for slots in "+locationid);
        }

        $scope.showParkingData = function(){
        var infoContent = '<div id="iw-container">' +
          '<div class="" >' +                       
               '<div class="iw-content">' +                 
                 '<div class="iw-subTitle">' +
                    '<p>Location name: ' + this.name.charging_station_name+'</p>' +
                '</div>' +
                 '<div class="iw-subTitle">' +
                    '<p>Location Desc: ' + this.name.charging_station_desc+'</p>' +
                '</div>' +
                '<div class="iw-subTitle">' +
                    '<p>Available Slots: '+ this.name.available+'</p>' +
                '</div>' +  
                '<div class="iw-subTitle">' +
                    '<p>Total Slots: '+ this.name.total+'</p>' +
                '</div>' +                  
                '<div class="iw-subTitle">' +
                '<a href="./displayPage.php?locationid='+this.name.charging_station_id+'"><button type="submit" class="btn btn-xs btn-success btn pull-right" style="margin-right:10px; margin-bottom:10px" >Check Available Slots</button></a>' +
                '</div>' +
              '</div>' +
              '<div class="iw-bottom-gradient">' +
              '</div>' +            
            '</div>' +
          '</div>';
      infowindow.setContent(infoContent);
          
      google.maps.event.addListener(infowindow, 'domready', function() {
        // Reference to the DIV that wraps the bottom of infowindow
        var iwOuter = $('.gm-style-iw');
        var iwBackground = iwOuter.prev();
        iwBackground.children(':nth-child(2)').css({'display' : 'none'});
      iwBackground.children(':nth-child(4)').css({'display' : 'none'});
        iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});
        var iwCloseBtn = iwOuter.next();
        iwCloseBtn.css({opacity: '1', right: '30px', top: '9px', 'box-shadow': '0 0 5px #3990B9'});
        if($('.iw-content').height() < 140){
          $('.iw-bottom-gradient').css({display: 'none'});
        }
        iwCloseBtn.mouseout(function(){
          $(this).css({opacity: '1'});
        });
      });
  
    infowindow.open($scope.map, this);
    }

        $scope.setLocations();
      });
  </script>
  </body>
</html>
