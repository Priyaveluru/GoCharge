<?php
$charging_station_id = $_POST["cStationId"];
if(isset($charging_station_id)){
    require_once('./dbconnect.php');
    // $charging_station_id = $_GET['locationid'];
    $query1 = "update charging_station set is_deleted = 1 where charging_station_id = '$charging_station_id';";
    $result1 = mysql_query($query1) or die(mysql_error());
    echo json_encode($charging_station_id );
}
?>