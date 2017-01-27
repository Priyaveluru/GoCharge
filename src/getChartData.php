<?php
		require_once('./dbconnect.php');
        $endDate = date("Y-m-d",strtotime($_POST["endDate"]));
        $startDate = date("Y-m-d",strtotime($_POST["startDate"]));
	 	if (isset($startDate)) {
            //echo "submitted";
            date_default_timezone_set('America/Los_Angeles');
            //$endDate = date("Y-m-d",strtotime($_POST["endDate"]));
            //$startDate = date("Y-m-d",strtotime($_POST["startDate"]));
            $units = $_POST["units"];
            $unitsDisplay = $_POST["units"];
            if($units=="month") {
                $unitsDisplay = "monthname";
            }
            if(strtotime($_POST["endDate"])<strtotime($_POST["startDate"])) {
                echo 'Invalid date selection';
            } else {
                //require instead of code
                if($_POST['locationid']==-1) {


                    $sql = "SELECT ".$unitsDisplay."(day_of_week) as d, sum(pricing.cost) as cost, count(*) as total_vehicles FROM pricing INNER JOIN slot ON slot.slot_id = pricing.slot_id INNER JOIN charging_station l ON l.charging_station_id = slot.charging_station_id
							WHERE pricing.day_of_week>= '".$startDate."'
							AND pricing.day_of_week <= '".$endDate."'
							AND pricing.cost IS NOT NULL
							GROUP BY ".$units."(d) ORDER BY ".$units."(d);";
                    $result = mysql_query($sql) or die(mysql_error());
                    $cost = mysql_fetch_assoc($result)["cost"];

                    //print $sql;
                }
                else{
                    $sql = "SELECT ".$unitsDisplay."(day_of_week) as d, sum(pricing.cost) as cost, count(*) as total_vehicles FROM pricing INNER JOIN slot ON slot.slot_id = pricing.slot_id INNER JOIN charging_station l ON l.charging_station_id = slot.charging_station_id
							WHERE pricing.day_of_week >= '".$startDate."'
							AND pricing.day_of_week <= '".$endDate."'
							AND pricing.cost IS NOT NULL
							AND l.charging_station_id = ".$_POST['locationid']."
							GROUP BY ".$units."(d) ORDER BY ".$units."(d);";

                }
                //echo $query;
                $result = mysql_query($sql) or die(mysql_error());
                $resultData = array();
                while ($row = mysql_fetch_assoc($result))
                {
                    array_push($resultData, $row);
                }
                //var_dump($resultData);
                echo json_encode($resultData);
            }
        }
?>