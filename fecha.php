<?php 
date_default_timezone_set('America/Bogota');
$Valor=1000;
echo "Hora actual: ".date('H'); 
echo "<br>";
if(date('H')>=22||date('H')<6){
	echo "Hora noctura: ".($Valor*2);
	echo "<br>";
	}else{
		echo "Hora normal: ".$Valor;
		echo "<br>";
		}

?>