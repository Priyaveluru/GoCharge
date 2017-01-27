<?php
if(isset($_POST['register']))
{
require_once('./dbconnect.php');
session_start(); 

$username = $_SESSION["username"];
$area = $_POST['areaname']; 
$charging_name = $_POST['parkingname'];
$number_of_slots = $_POST['numberofslots'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$pricePerHour = $_POST['pricePerHour'];
$slotname = $_POST['slotname'];
$t=date("Y-m-d");
echo $t;
echo $lng;
echo $lat;
echo $area;
echo $charging_name;
echo $number_of_slots;

$sql="SELECT user_id from charging_user where emailid='$username'";
	$result = mysql_query($sql) or die(mysql_error());
	//echo $slot_id;
	//echo $username;
	$user_id = mysql_fetch_assoc($result)["user_id"];
	
	
$sql="INSERT INTO charging_station (vendor_id,charging_station_name,charging_station_desc,latitude,longitude,cost, capacity ,timestamp,status,is_deleted) VALUES ('$user_id','$charging_name','$area',$lat,$lng, $pricePerHour, $number_of_slots,'$t','Available',0)";
if(mysql_query($sql)) 
{
	$sensor_id=mysql_insert_id();
	$charging_station_id = mysql_insert_id();
	$sql = "insert into sensor (sensor_id,sensor_name,charging_station_id,location,status) values (".$sensor_id.",'Physical Sensor',".$charging_station_id.",'".$area."','Available');";
	$result = mysql_query($sql) or die(mysql_error()); 
	for($i=1; $i<=$number_of_slots;$i++) {
		$sql = "insert into slot (charging_station_id,user_id,slot_name, type, is_free,status) values (".$charging_station_id.",".$user_id.",'".$slotname.$i."',1,0,'Available');";
		$result = mysql_query($sql) or die(mysql_error()); 
	}
	 setcookie("Registration", $area.":".$charging_name.":".$number_of_slots, time()+3600);
	 header("Location:./vendorRegisterSuccess.php");
}
	
else
{
	die(mysql_error());
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script>
	
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode( { 'address': <<enteredAddress>>},  function(results, status) {
			  if (status == google.maps.GeocoderStatus.OK) {
				    var destination1 = {
				    	lat:results[0].geometry.location.lat(),
				    	lng:results[0].geometry.location.lng()
				    };
                            else {
		alert("Invalid destination address, please enter again");
	}
	</script>
</head>
<body>
</body>
</html>


