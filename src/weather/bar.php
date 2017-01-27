<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');

$data1y = array(240,480,100,550,750,550,660,700);



// Create the graph. These two calls are always required
$graph = new Graph(1200,600,'auto');
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;
$graph->SetTheme($theme_class);

$graph->yaxis->SetTickPositions(array(0,100,200,300,400,500,600,700), array(50,150,250,350,450,550,650,750));
$graph->SetBox(false);

$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels(array('2015-11-03','2015-11-04','2015-11-05','2015-11-06','2015-11-07','2015-11-08','2015-11-09','2015-11-10'));
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

// Create the bar plots
$b1plot = new BarPlot($data1y);
//$b2plot = new BarPlot($data2y);
//$b3plot = new BarPlot($data3y);

// Create the grouped bar plot

$gbplot = new GroupBarPlot(array($b1plot));
// ...and add it to the graPH
$graph->Add($gbplot);


$b1plot->SetColor("white");
$b1plot->SetFillColor("#11cccc");
/*
$b2plot->SetColor("white");
$b2plot->SetFillColor("#11cccc");

$b3plot->SetColor("white");
$b3plot->SetFillColor("#1111cc");
*/
$graph->title->Set("Parking Revenue");

// Display the graph
$graph->Stroke();
?>