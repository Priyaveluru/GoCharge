<?php
$charging_station_id = $_POST["cStationId"];
$Sensor_name   = $_POST["cStationName"];
$status    = $_POST["cStationStatus"];
if(isset($charging_station_id)){
    require_once('./dbconnect.php');
    // $charging_station_id = $_GET['locationid'];
    $query = "update Sensor set sensor = '$Sensor_name', status = '$status' where charging_station_id = '$charging_station_id';";
    $result = mysql_query($query) or die(mysql_error());
    echo json_encode($result);
}
?>