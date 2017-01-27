<?php
$slot_id = $_POST["slotId"];
if(isset($slot_id)){
    require_once('./dbconnect.php');

    $query1 = "delete from slot where slot_id = '$slot_id';";
    $result1 = mysql_query($query1) or die(mysql_error());
    echo json_encode($result1);
}
?>