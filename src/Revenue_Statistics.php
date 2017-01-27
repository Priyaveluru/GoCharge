<?php
		require_once('./dbconnect.php');
		//echo "check";
	 	if (isset($_POST['submit'])) {
			//echo "submitted";
		 	date_default_timezone_set('America/Los_Angeles');

		 	$endDate = date("Y-m-d",strtotime($_POST["endDate"]));	 	
		 	$startDate = date("Y-m-d",strtotime($_POST["startDate"]));	 	
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
	 	}
	 }
?>	
<html>
<head>
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="js/highcharts.js"></script>
	<script src="js/exporting.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.ico">

    <title>Narrow Jumbotron Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
	<link href="bootswatch/paper/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron-narrow.css" rel="stylesheet">

	<!-- Custom styles for SmartPark -->
    <link href="css/style.css" rel="stylesheet">
	
	<!-- beautiful fonts -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,300" rel="stylesheet" type="text/css">
	
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
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
<script type="text/javascript">

		var chartData = <?php echo json_encode($resultData); ?>;
		var categoryNames = new Array();
		var values = new Array();
		var total = new Array();
		for(var i=0; i<chartData.length; i++) {
			categoryNames.push(chartData[i]['d']);
			values.push(parseInt(chartData[i]['cost']));	
			total.push(parseInt(chartData[i]['total_vehicles']));
		}
		//console.log(JSON.stringify(categoryNames));
		
$(function () {
	Highcharts.theme = {
		colors: ['#2b908f', '#90ee7e', '#f45b5b', '#7798BF', '#aaeeee', '#ff0066', '#eeaaee',
			'#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
		chart: {
			backgroundColor: {
				linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
				stops: [
					[0, '#2a2a2b'],
					[1, '#3e3e40']
				]
			},
			style: {
				fontFamily: '\'Unica One\', sans-serif'
			},
			plotBorderColor: '#606063'
		},
		title: {
			style: {
				color: '#E0E0E3',
				textTransform: 'uppercase',
				fontSize: '20px'
			}
		},
		subtitle: {
			style: {
				color: '#E0E0E3',
				textTransform: 'uppercase'
			}
		},
		xAxis: {
			gridLineColor: '#707073',
			labels: {
				style: {
					color: '#E0E0E3'
				}
			},
			lineColor: '#707073',
			minorGridLineColor: '#505053',
			tickColor: '#707073',
			title: {
				style: {
					color: '#A0A0A3'

				}
			}
		},
		yAxis: {
			gridLineColor: '#707073',
			labels: {
				style: {
					color: '#E0E0E3'
				}
			},
			lineColor: '#707073',
			minorGridLineColor: '#505053',
			tickColor: '#707073',
			tickWidth: 1,
			title: {
				style: {
					color: '#A0A0A3'
				}
			}
		},
		tooltip: {
			backgroundColor: 'rgba(0, 0, 0, 0.85)',
			style: {
				color: '#F0F0F0'
			}
		},
		plotOptions: {
			series: {
				dataLabels: {
					color: '#B0B0B3'
				},
				marker: {
					lineColor: '#333'
				}
			},
			boxplot: {
				fillColor: '#505053'
			},
			candlestick: {
				lineColor: 'white'
			},
			errorbar: {
				color: 'white'
			}
		},
		legend: {
			itemStyle: {
				color: '#E0E0E3'
			},
			itemHoverStyle: {
				color: '#FFF'
			},
			itemHiddenStyle: {
				color: '#606063'
			}
		},
		credits: {
			style: {
				color: '#666'
			}
		},
		labels: {
			style: {
				color: '#707073'
			}
		},

		drilldown: {
			activeAxisLabelStyle: {
				color: '#F0F0F3'
			},
			activeDataLabelStyle: {
				color: '#F0F0F3'
			}
		},

		navigation: {
			buttonOptions: {
				symbolStroke: '#DDDDDD',
				theme: {
					fill: '#505053'
				}
			}
		},

		// scroll charts
		rangeSelector: {
			buttonTheme: {
				fill: '#505053',
				stroke: '#000000',
				style: {
					color: '#CCC'
				},
				states: {
					hover: {
						fill: '#707073',
						stroke: '#000000',
						style: {
							color: 'white'
						}
					},
					select: {
						fill: '#000003',
						stroke: '#000000',
						style: {
							color: 'white'
						}
					}
				}
			},
			inputBoxBorderColor: '#505053',
			inputStyle: {
				backgroundColor: '#333',
				color: 'silver'
			},
			labelStyle: {
				color: 'silver'
			}
		},

		navigator: {
			handles: {
				backgroundColor: '#666',
				borderColor: '#AAA'
			},
			outlineColor: '#CCC',
			maskFill: 'rgba(255,255,255,0.1)',
			series: {
				color: '#7798BF',
				lineColor: '#A6C7ED'
			},
			xAxis: {
				gridLineColor: '#505053'
			}
		},

		scrollbar: {
			barBackgroundColor: '#808083',
			barBorderColor: '#808083',
			buttonArrowColor: '#CCC',
			buttonBackgroundColor: '#606063',
			buttonBorderColor: '#606063',
			rifleColor: '#FFF',
			trackBackgroundColor: '#404043',
			trackBorderColor: '#404043'
		},

		// special colors for some of the
		legendBackgroundColor: 'rgba(0, 0, 0, 0.5)',
		background2: '#505053',
		dataLabelsColor: '#B0B0B3',
		textColor: '#C0C0C0',
		contrastTextColor: '#F0F0F3',
		maskColor: 'rgba(255,255,255,0.3)'
	};

	Highcharts.setOptions(Highcharts.theme);
    $('#container').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Revenue Statistics'
        },
        subtitle: {
            text: ' '
        },
        xAxis: {
            categories: categoryNames,
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: '',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' '
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            /*y: 80,*/
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Total revenue',
            data: values
        }]
    });
	
    });
		</script>	
		
</head>
<body>
<div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
			  <li role="presentation"><a href="admin.php">Home</a></li>
			  <li role="presentation" class="active"><a href="Revenue_Statistics.php">Revenue Statistics</a></li>
			  <!-- <li role="presentation"><a href="about.php">About</a></li>-->
			  <li role="presentation"><a href="logout.php">Logout</a></li>
          </ul>
        </nav>
        <h3 class="page-header">Go Charge</h3>
      </div>
      <div class="jumbotron">
		  <div class="row" style="margin-top:-45px;" >
			  <form method="POST" action="Revenue_Statistics.php" id="checkStats" validate>
				  <div class="col-md-2" style="padding-left:2px;padding-right:0px;">Start Date<input type="text" name="startDate" id="datepicker" class="form-control" form="checkStats" required/></div>
				  <div class="col-md-2" style="padding-left:2px;padding-right:0px;">End Date<input type="text" name="endDate" id="datepicker2" class="form-control" form="checkStats" required/></div>
				  <div class="col-md-3" style="padding-left:2px;padding-right:0px;">Location<select name="locationid" style="margin-bottom:2px; " class="form-control" form="checkStats">
						  <option value="-1">All</option>
					  </select></div>
				  <div class="col-md-3" style="padding-left:2px;padding-right:0px;">By<select name="units" style="margin-bottom:2px; " class="form-control" form="checkStats">
						  <option value="date">Daily</option>
						  <option value="week">Weekly</option>
						  <option value="month">Monthly</option>
						  <option value="year">Yearly</option>
					  </select>
				  </div>
				  <div class="col-md-1" style="padding-left:2px;padding-right:0px;padding-top:25px;">
					  <input type="submit" name="submit" class="btn btn-sm btn-info" value="Filter">
				  </div>
				  <div class="col-md-1" style="padding-left:2px;padding-right:0px;padding-top:25px;">
					  <input type="reset" class="btn btn-sm btn-warning" value="Reset">
				  </div>
			  </form>
		  </div>
		  <div class="row" style="margin-top:-20px;">
			  <div class="col-md-12" style="padding:5px;"><div id="container"></div></div>
		  </div>
 <footer class="footer">
        <p>&copy; Go Charge 2016</p>
      </footer>

    </div>
</body>
</html>