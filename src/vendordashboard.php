<?php
require_once('./dbconnect.php');
session_start();
$username = $_SESSION["username"];
$sql="SELECT COUNT(`charging_station_id`) AS charging_stations FROM `charging_station` c LEFT JOIN charging_user cu ON cu.user_id = c.vendor_id WHERE emailid='$username'";
$result = mysql_query($sql) or die(mysql_error());
$charging_stations = mysql_fetch_assoc($result)["charging_stations"];
$sql="SELECT COUNT(`charging_station_id`) AS inactive_stations FROM `charging_station` c LEFT JOIN charging_user cu ON cu.user_id = c.vendor_id WHERE emailid='$username'and  STATUS='inactive'";
$result = mysql_query($sql) or die(mysql_error());
$inactive_stations  = mysql_fetch_assoc($result)["inactive_stations"];
$sql="SELECT COUNT(`charging_station_id`) AS avaialble FROM `charging_station` c LEFT JOIN charging_user cu ON cu.user_id = c.vendor_id WHERE emailid='$username'and  STATUS='Available'";
$result = mysql_query($sql) or die(mysql_error());
$available_stations  = mysql_fetch_assoc($result)["avaialble"];
$sql="SELECT SUM(p.cost) as cost FROM pricing p LEFT JOIN charging_station c ON c.charging_station_id =p.charging_station_id LEFT JOIN charging_user cu ON cu.user_id =c.vendor_id 
WHERE cu.emailid='".$username . "'";
$result = mysql_query($sql) or die(mysql_error());
$Revenue= mysql_fetch_assoc($result)["cost"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.ico">

    <title>Vendor Dashboard</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="bootswatch/paper/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron-narrow.css" rel="stylesheet">

    <!-- Custom styles for SmartPark -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <!-- beautiful fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,300" rel="stylesheet" type="text/css">
    <script src="js/ie-emulation-modes-warning.js"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<body>
<div class="container">
    <div class="header clearfix">
        <nav>
            <ul class="nav nav-pills pull-right">
			    <li role="presentation" class="active"><a href="vendordashboard.php">Vendor Dashboard</a></li>
                <li role="presentation"><a href="about_vendor.php">About</a></li>
                <li role="presentation"><a href="Contact_vendor.php">Contact</a></li>
				<li role="presentation"><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <h3 class="page-header">Go Charge</h3>
    </div>
    <h2></h2>
    <div class="jumbotron" style="margin-top:-30px;">
        <div class="row circleStats" style="margin-top:-15px;" >
            <h4>Vendor Dashboard</h4>
			<div class="col-md-6" style="margin-top:-39px;margin-left:387px">
                    <button class="btn btn-success btn-sm" data-title="add"
                            onclick="window.location.href='vendorSpaceRegister.php'"><i class="fa fa-plus-circle"></i>&nbsp;Create Charging Station
                    </button>
                </div>
            <div class="col-md-3" style="padding-left:2px;padding-right:0px;">
                <div class="circleStatsItemBox greenDark">
                    <div class="header">Total Stations </div>
                    <span class="percent"></span>
                    <div class="circleStat">
                        <input type="text" value=<?php echo $charging_stations;?> class="whiteCircle" />
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="padding-left:2px;padding-right:0px;">
                <div class="circleStatsItemBox blueDark">
                    <div class="header">InActive Stations</div>
                    <span class="percent"></span>
                    <div class="circleStat">
                        <input type="text" value=<?php echo $inactive_stations ;?> class="whiteCircle" />
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="padding-left:2px;padding-right:0px;">
                <div class="circleStatsItemBox orangeDark">
                    <div class="header">Available Stations</div>
                    <span class="percent"></span>
                    <div class="circleStat">
                        <input type="text" value=<?php echo $available_stations;?> class="whiteCircle" />
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="padding-left:2px;padding-right:0px;">
                <div class="circleStatsItemBox purple">
                    <div class="header">Revenue</div>
                    <span class="percent"></span>
                    <div class="circleStat">
                        <input type="text" value="<?php echo $Revenue;?>" class="whiteCircle" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <form method="POST" action="charts.php" id="checkStats" validate>
                <div class="col-md-2" style="padding-left:2px;padding-right:0px;">Start Date<input type="text" name="startDate" id="datepicker" class="form-control" form="checkStats" required/></div>
                <div class="col-md-2" style="padding-left:2px;padding-right:0px;">End Date<input type="text" name="endDate" id="datepicker2" class="form-control" form="checkStats" required/></div>
                <div class="col-md-3" style="padding-left:2px;padding-right:0px;">Location<select name="locationid" id="locationid" style="margin-bottom:2px; " class="form-control" form="checkStats">
                        <option value="-1">All</option>
                    </select></div>
                <div class="col-md-3" style="padding-left:2px;padding-right:0px;">By<select name="units" id="units" style="margin-bottom:2px; " class="form-control" form="checkStats">
                        <option value="date">Daily</option>
                        <option value="month">Monthly</option>
                        <option value="year">Yearly</option>
                    </select>
                </div>
                <div class="col-md-1" style="padding-left:2px;padding-right:0px;padding-top:25px;">
                    <input type="submit" name="submit" class="btn btn-sm btn-primary" id="filter" value="Filter">
                </div>
                <div class="col-md-1" style="padding-left:2px;padding-right:0px;padding-top:25px;">
                    <input type="reset" class="btn btn-sm btn-warning" value="Reset">
                </div>
            </form>
        </div>
        <div class="row">
            <div id="container"></div>
        </div>
    </div>

    <script src="js/circlestats/jquery-1.9.1.min.js"></script>
    <script src="js/circlestats/jquery-migrate-1.0.0.min.js"></script>

    <script src="js/highcharts.js"></script>
    <script src="js/exporting.js"></script>
    <script src="js/circlestats/jquery-ui-1.10.0.custom.min.js"></script>

    <script src="js/circlestats/jquery.ui.touch-punch.js"></script>

    <script src="js/circlestats/modernizr.js"></script>

    <script src="js/circlestats/bootstrap.min.js"></script>

    <script src="js/circlestats/jquery.cookie.js"></script>

    <script src='js/circlestats/fullcalendar.min.js'></script>

    <script src='js/circlestats/jquery.dataTables.min.js'></script>

    <script src="js/circlestats/excanvas.js"></script>
    <script src="js/circlestats/jquery.flot.js"></script>
    <script src="js/circlestats/jquery.flot.pie.js"></script>
    <script src="js/circlestats/jquery.flot.stack.js"></script>
    <script src="js/circlestats/jquery.flot.resize.min.js"></script>

    <script src="js/circlestats/jquery.chosen.min.js"></script>

    <script src="js/circlestats/jquery.uniform.min.js"></script>

    <script src="js/circlestats/jquery.cleditor.min.js"></script>

    <script src="js/circlestats/jquery.noty.js"></script>

    <script src="js/circlestats/jquery.elfinder.min.js"></script>

    <script src="js/circlestats/jquery.raty.min.js"></script>

    <script src="js/circlestats/jquery.iphone.toggle.js"></script>

    <script src="js/circlestats/jquery.uploadify-3.1.min.js"></script>

    <script src="js/circlestats/jquery.gritter.min.js"></script>

    <script src="js/circlestats/jquery.imagesloaded.js"></script>

    <script src="js/circlestats/jquery.masonry.min.js"></script>

    <script src="js/circlestats/jquery.knob.modified.js"></script>

    <script src="js/circlestats/jquery.sparkline.min.js"></script>

    <script src="js/circlestats/counter.js"></script>

    <script src="js/circlestats/retina.js"></script>

    <script src="js/circlestats/custom.js"></script>
     <script src="js/highcharts.js"></script>
    <script src="js/exporting.js"></script>
    <script type="text/javascript">
        $(document).ready(
            /* This is the function that will get executed after the DOM is fully loaded */
            function () {
                $( "#datepicker" ).datepicker({
                    changeMonth: true,//this option for allowing user to select month
                    changeYear: true //this option for allowing user to select from year range
                });
                $( "#datepicker2" ).datepicker({
                    changeMonth: true,//this option for allowing user to select month
                    changeYear: true //this option for allowing user to select from year range
                });
            }

        );
    </script>

</body>
</html>
