<?php
$charging_station_id = $_GET['locationid'];
require_once('./dbconnect.php');
$sql = "SELECT COUNT(slot_id)as total_slots FROM slot where charging_station_id='$charging_station_id'";
$result = mysql_query($sql) or die(mysql_error());
$total_slots = mysql_fetch_assoc($result)["total_slots"];
$sql = "SELECT COUNT(slot_id) as inactive_slots FROM slot WHERE STATUS='Inactive' and charging_station_id='$charging_station_id'";
$result = mysql_query($sql) or die(mysql_error());
$inactive_slots = mysql_fetch_assoc($result)["inactive_slots"];
$sql = "SELECT COUNT(slot_id) as available_slots FROM slot WHERE STATUS='Available' and charging_station_id='$charging_station_id'";
$result = mysql_query($sql) or die(mysql_error());
$available_slots = mysql_fetch_assoc($result)["available_slots"];
$sql = "SELECT COUNT(slot_id) as available_slots FROM slot WHERE STATUS='Available' and charging_station_id='$charging_station_id'";
$result = mysql_query($sql) or die(mysql_error());
$available_slots = mysql_fetch_assoc($result)["available_slots"];
$sql = "SELECT SUM(cost) as revenue FROM pricing WHERE `charging_station_id`='$charging_station_id'";
$result = mysql_query($sql) or die(mysql_error());
$revenue = mysql_fetch_assoc($result)["revenue"];
$sql = "SELECT slot_name,slot_id FROM slot WHERE `charging_station_id` ='$charging_station_id'";
$result = mysql_query($sql) or die(mysql_error());
$slotData = array();
while ($row = mysql_fetch_assoc($result)) {
    array_push($slotData, $row);
}

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

    <title>Manage Slots</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="bootswatch/paper/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron-narrow.css" rel="stylesheet">

    <link href="css/font-awesome.min.css" rel="stylesheet">


    <!-- Custom styles for SmartPark -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
    <!-- beautiful fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,300" rel="stylesheet" type="text/css">
    <script src="js/ie-emulation-modes-warning.js"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">
        <div class="header clearfix">
            <nav>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation"><a href="admin.php">Home</a></li>
					<li role="presentation" class="active"><a href="manageslots.php">Manage Slots</a></li>
                    <!--<li role="presentation"><a href="about.php">About</a></li>-->
                    <li role="presentation"><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
            <h3 class="page-header">Go Charge</h3>
        </div>
        <h2></h2>
        <div class="jumbotron" style="margin-top:-30px;">
            <div class="row circleStats" style="margin-top:-15px;">
                <h4>Manage Slots</h4>
                <div class="col-md-3" style="padding-left:2px;padding-right:0px;">
                    <div class="circleStatsItemBox blue">
                        <div class="header">Total Slots</div>
                        <span class="percent"></span>
                        <div class="circleStat">
                            <input type="text" value="<?php echo $total_slots; ?>" class="whiteCircle"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" style="padding-left:2px;padding-right:0px;">
                    <div class="circleStatsItemBox green">
                        <div class="header">InActive Slots</div>
                        <span class="percent"></span>
                        <div class="circleStat">
                            <input type="text" value="<?php echo $inactive_slots; ?>" class="whiteCircle"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" style="padding-left:2px;padding-right:0px;">
                    <div class="circleStatsItemBox pink">
                        <div class="header">Available Slots</div>
                        <span class="percent"></span>
                        <div class="circleStat">
                            <input type="text" value="<?php echo $available_slots; ?>" class="whiteCircle"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" style="padding-left:2px;padding-right:0px;">
                    <div class="circleStatsItemBox orange">
                        <div class="header">Revenue</div>
                        <span class="percent"></span>
                        <div class="circleStat">
                            <input type="text" value="$<?php echo $revenue; ?>" class="whiteCircle"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top:10px;">
                <input type="hidden" id="chargingStation-id" value="<?php echo $charging_station_id; ?>"/>
                <div class="col-md-6" style="float:left">
                    <button class="btn btn-success btn-sm" style="margin-left:-15px;float:left;" data-title="add"
                            onclick="addSlot()"><i class="fa fa-plus-circle"></i>&nbsp;Add Slot
                    </button>
                </div>
                <div class="col-md-6" style="float:right">
                    <div class="custom-circle greenLight" style="float:left;margin-left:25px;margin-right:5px;"></div>
                    <div style="float:left">Available</div>
                    <div class="custom-circle blue" style="float:left;margin-left:20px;margin-right:5px;"></div>
                    <div style="float:left;">Busy</div>
                    <div class="custom-circle orangeDark" style="float:left;margin-left:20px;margin-right:5px;"></div>
                    <div style="float:left">In Active</div>
                </div>
            </div>
            <div class="row" style="margin-top:10px;">
                <table class="table" style="border:1px solid;border-color:#fff;" border='1'>
                    <thead style="color:orange;">
                    <th style="width:15%;text-align:center;border:1px solid;">Slot #</th>
                    <th style="width:40%;text-align:center;border:1px solid;">Slot Name</th>
                    <th style="width:15%;text-align:center;border:1px solid;">Status</th>
                    <th style="text-align:center;width:25%;border:1px solid;"></th>
                    </thead>
                    <tbody>
                    <?php
                    for ($i = 0; $i < count($slotData); $i++) {

                        echo '<tr style="border-color:#fff;">';
                        echo '<td style="width:15%;text-align:center;border-color:#fff;border:1px solid;">' . $slotData[$i]['slot_id'] . '</td>';
                        echo ' <td style="text-align:center;width:40%;border-color:#fff;border:1px solid;">
                            ' . $slotData[$i]['slot_name'] . '
                            </td>';
                        $sql = "SELECT slot_id FROM slot WHERE slot_name='" . $slotData[$i]['slot_name'] . "'";
                        $result = mysql_query($sql) or die(mysql_error());
                        $slot_id = mysql_fetch_assoc($result)["slot_id"];
                        $sql = "SELECT STATUS FROM slot WHERE slot_id='" . $slotData[$i]['slot_id'] . "'";
                        $result = mysql_query($sql) or die(mysql_error());
                        $status = mysql_fetch_assoc($result)["STATUS"];
                        switch ($status) {
                            case "Inactive":
                                echo '<td style="width:15%;text-align:center;border-color:#fff;border:1px solid;"><div class="custom-circle orangeDark" ></div></td>';
                                break;
                            case "Available":
                                echo '<td style="width:15%;text-align:center;border-color:#fff;border:1px solid;"><div class="custom-circle greenLight" ></div></td>';
                                break;
                            case "Busy":
                                echo '<td style="width:15%;text-align:center;border-color:#fff;border:1px solid;"><div class="custom-circle blue" ></div></td>';
                                break;
                            default:
                                echo '';
                        }
                        echo '<td style="width:25%;border-color:#fff;border:1px solid;">';
                        echo ' <div style="float:right">
                                    <button  class="btn btn-warning btn-sm" style="margin-right:5px;" id="' . $slotData[$i]['slot_id'] . '"  data-title="edit" data-slotStatus="' . $status . '" data-slotName="' . $slotData[$i]['slot_name'] . '"  onclick="editSlot(this)"><i class="fa fa-tag"></i>&nbsp;Edit</button>
                                    <button class="btn btn-danger btn-sm" style="margin-left:5px;" id="' . $slotData[$i]['slot_id'] . '"  onclick="deleteSlot(this)" ><i class="fa fa-trash"></i>&nbsp;Delete</button></td>';
                    }
                    '</td>
                        </tr>
                        </tbody>'; ?>
                </table>
            </div>

        </div>
        <div class="modal fade" id="editSlotModal" tabindex="-1" role="dialog" aria-labelledby="view"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" style="width:60%">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                                    class="fa fa-close" aria-hidden="true"></span></button>
                            <h4 class="modal-title custom_align" id="Heading">&nbsp;&nbsp;Edit Slot</h4>
                        </div>
                        <div class="modal-body">
                            <div id='editSlotModal-content' style="margin-left:5px;">
                                <input type="hidden" id="editSlot-id" value=""/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="editSlot-name">Slot Name</label>
                                        <input type="text" class="form-control" style="color:#000" name="editSlot-name"
                                               id="editSlot-name"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="editSlot-status">Status</label>
                                        <select id="editSlot-status" class="form-control" style="color:#000">
                                            <option value="Available">Available</option>
                                            <option value="Inactive">In Active</option>
                                            <option value="Busy">Busy</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>     <!-- End of Modal Body-->
                        <div class="modal-footer ">
                            <button id="slot-edit" name="Edit Slot" class="btn btn-success btn-sm" onclick=updateSlot()>
                                <i class="fa fa-check-circle"></i>&nbsp;Update Slot
                            </button>
                            <button class="btn btn-primary btn-sm" data-dismiss="modal" id="close"><i
                                    class="fa fa-times-circle"></i>&nbsp;Close
                            </button>
                        </div>
                    </div> <!-- /.modal-content -->
                </div> <!-- /.modal-dialog -->
            </div> <!-- /.modal-fade -->
        <div class="modal fade" id="addSlotModal" tabindex="-1" role="dialog" aria-labelledby="view"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" style="width:60%">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                                    class="fa fa-close" aria-hidden="true"></span></button>
                            <h4 class="modal-title custom_align" id="Heading">&nbsp;&nbsp;Add Slot</h4>
                        </div>
                        <div class="modal-body">
                            <form id="addSlotForm" name="addSlotForm" class="form-horizontal">
                                <div id='addSlotModal-content' style="margin-left:5px;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="addSlot-name">Slot Name</label>
                                            <input type="text" required class="form-control" style="color:#000"
                                                   name="addSlotName" id="addSlot-name"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="addSlot-status">Status</label>
                                            <select name="addSlotStatus" id="addSlot-status" required
                                                    class="form-control" style="color:#000">
                                                <option value="Available">Available</option>
                                                <option value="Inactive">In Active</option>
                                                <option value="Busy">Busy</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>     <!-- End of Modal Body-->
                        <div class="modal-footer ">
                            <button id="slot-add" name="AddSlot" class="btn btn-success btn-sm" onclick="insertSlot()">
                                <i class="fa fa-check-circle"></i>&nbsp;Add Slot
                            </button>
                            <button class="btn btn-primary btn-sm" data-dismiss="modal" id="close"><i
                                    class="fa fa-times-circle"></i>&nbsp;Close
                            </button>
                        </div>

                    </div> <!-- /.modal-content -->
                </div> <!-- /.modal-dialog -->
            </div> <!-- /.modal-fade -->

    </div>

            <script>
                function addSlot() {
                    document.getElementById("addSlotForm").reset();
                    $('#addSlotModal').modal('show');
                }
                function insertSlot() {
                    var chargingStationId = $('#chargingStation-id').val();
                    var slotName = $('#addSlot-name').val();
                    if (slotName == '') {
                        alert('Slot Name Required !!');
                        return;
                    }
                    var slotStatus = $('#addSlot-status').val();
                    $.ajax({
                        url: "addSlot.php",
                        type: "POST",
                        data: {
                            chargingStationId: chargingStationId,
                            slotName: slotName,
                            slotStatus: slotStatus
                        },
                        dataType: "JSON",
                        success: function (jsonStr) {
                            location.reload(true);
                            alert('Inserted Successfully!!!');
                            $('#addSlotModal').modal('hide');
                        },
                        error: function (err) {
                            alert(JSON.stringify(err));
                            $('#addSlotModal').modal('hide');
                        }
                    });

                }

                function editSlot(element) {
                    $('#editSlot-id').val('');
                    $('#editSlot-id').val(element.id);
                    $('#editSlot-name').val(element.getAttribute('data-slotName'));
                    $('#editSlot-status').val(element.getAttribute('data-slotStatus'));
                    $('#editSlotModal').modal('show');
                }

                function deleteSlot(element) {
                    var slotId = element.id;
                    var confirmValue = confirm('Sure you want to delete ? ');
                    if (confirmValue) {
                        $.ajax({
                            url: "deleteSlot.php",
                            type: "POST",
                            data: {
                                slotId: slotId
                            },
                            dataType: "JSON",
                            success: function (jsonStr) {
                                alert('Deleted Successfully !!');
                                location.reload(true);
                            },
                            error: function (err) {
                                alert('Error While Deleting !!' + JSON.stringify(err));
                            }
                        });
                    }
                }
                function updateSlot() {
                    var slotId = $('#editSlot-id').val();
                    var slotName = $('#editSlot-name').val();
                    var slotStatus = $('#editSlot-status').val();
                    $.ajax({
                        url: "updateSlot.php",
                        type: "POST",
                        data: {
                            slotId: slotId,
                            slotName: slotName,
                            slotStatus: slotStatus
                        },
                        dataType: "JSON",
                        success: function (jsonStr) {
                            location.reload(true);
                            alert('Updated Successfully!!!');
                            $('#editSlotModal').modal('hide');
                        },
                        error: function (err) {
                            alert(JSON.stringify(err));
                            $('#editSlotModal').modal('hide');
                        }
                    });

                }
            </script>
            <script src="js/circlestats/jquery-1.9.1.min.js"></script>
            <script src="js/circlestats/jquery-migrate-1.0.0.min.js"></script>

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

            <script type="text/javascript">
                $(document).ready(
                    /* This is the function that will get executed after the DOM is fully loaded */
                    function () {
                        $("#datepicker").datepicker({
                            changeMonth: true,//this option for allowing user to select month
                            changeYear: true //this option for allowing user to select from year range
                        });
                        $("#datepicker2").datepicker({
                            changeMonth: true,//this option for allowing user to select month
                            changeYear: true //this option for allowing user to select from year range
                        });

                 
                   

                    }
                );
            </script>
</body>
</html>
