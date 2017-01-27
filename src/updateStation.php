<?php
$charging_station_id = $_POST["cStationId"];
$charging_station_name   = $_POST["cStationName"];
$status    = $_POST["cStationStatus"];
if(isset($charging_station_id)){
    require_once('./dbconnect.php');
    // $charging_station_id = $_GET['locationid'];
    $query = "update charging_station set charging_station_name = '$charging_station_name', status = '$status' where charging_station_id = '$charging_station_id';";
    $result = mysql_query($query) or die(mysql_error());
    echo json_encode($result);
}
?>