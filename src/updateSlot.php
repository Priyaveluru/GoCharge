<?php
$slotId = $_POST["slotId"];
$slotName   = $_POST["slotName"];
$status    = $_POST["slotStatus"];
if(isset($slotId)){
    require_once('./dbconnect.php');
    // $charging_station_id = $_GET['locationid'];
    $query = "update slot set slot_name = '$slotName', status = '$status' where slot_id = '$slotId';";
    $result = mysql_query($query) or die(mysql_error());
    echo json_encode($result);
}
?>