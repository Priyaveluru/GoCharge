<?php
$chargingStationId = $_POST["chargingStationId"];
$slotName   = $_POST["slotName"];
$status    = $_POST["slotStatus"];
if(isset($chargingStationId)){
    require_once('./dbconnect.php');
    // $charging_station_id = $_GET['locationid'];
    $query1 = "select user_id from slot where charging_station_id = $chargingStationId limit 1;";
    $result1 = mysql_query($query1) or die(mysql_error());
    $user_id = mysql_fetch_assoc($result1)['user_id'];
    //$query2 = "insert into slot values(null,1,0,'$userId','$chargingStationId','$slotName', '$status'";
    $query2 = "insert into slot (charging_station_id,user_id,slot_name, type, is_free, status) values (".$chargingStationId.",".$user_id.",'".$slotName."',1,0,'".$status."');";
    $result2 = mysql_query($query2) or die(mysql_error());
    echo json_encode($result2);
}
?>