<?php

//$Consulta_CantMovil="SELECT Id_Movil, Count(*) as Cant FROM Recibo Group by Id_Movil";
//$SQL_CantMovil=mysql_query($Consulta_CantMovil,$conexion);
/*if($SQL_CantMovil){
	$Num_CantMovil=mysql_num_rows($SQL_CantMovil);
}*/

// content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');
//require('conexion.php');
/*
$datay=array();
$movil=array();//('3','9','10','13','17','21','29','56')
$i=0;
while($row_CantMovil=mysql_fetch_array($SQL_CantMovil)){
	$datay[]=$row_CantMovil['Cant'];
	}
$SQL_Movil=mysql_query($Consulta_CantMovil,$conexion);	
while($row_Movil=mysql_fetch_array($SQL_Movil)){
	$movil[]=$row_Movil['Id_Movil'];
	}	
	*/
/*	
for($j=0;$j<10;$j++){
	echo $datay[$j];
	echo "<br>";
	}
	
for($j=0;$j<10;$j++){
	echo $movil[$j];
	echo "<br>";
	}
exit();*/
// Create the graph. These two calls are always required
$graph = new Graph(500,220,'auto');
$graph->SetScale("textlin");

//$theme_class="DefaultTheme";
//$graph->SetTheme(new $theme_class());

// set major and minor tick positions manually
//$graph->yaxis->SetTickPositions(array(0,1,2,3,4,5), array(1.5,2.5,3.5,4.5));
$graph->SetBox(false);
$movil=array('3','9','10','13','17','21','29','56');
$datax=array('1','4','2','3','4','1','2','3');
//$graph->ygrid->SetColor('gray');
$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels($movil);
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

// Create the bar plots
$b1plot = new BarPlot($datax);

// ...and add it to the graPH
$graph->Add($b1plot);


$b1plot->SetColor("white");
$b1plot->SetFillGradient("#4B0082","white",GRAD_LEFT_REFLECTION);
$b1plot->SetWidth(45);
$graph->title->Set("Informe por Moviles");

// Display the graph
$graph->Stroke();
mysql_close($conexion);
?>