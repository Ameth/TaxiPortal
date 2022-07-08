<?php 
if(!isset($_POST['Id_Recibo'])||!isset($_POST['Id_Barrio'])||!isset($_POST['Id_Movil'])||!isset($_POST['Fecha'])||!isset($_POST['Hora'])){echo ""; exit();}else{
	require('conexion.php');
	$Consulta="INSERT INTO Recibo
	VALUES(
	  '".$_POST['Id_Recibo']."'
	 ,'".$_POST['Id_Movil']."'
	 ,'".$_POST['Id_Barrio']."'
	 ,'".$_POST['Fecha']."'
	 ,'".$_POST['Hora']."'
	 ,'".$_POST['Valor']."');";
	$SQL=mysql_query($Consulta,$conexion);
	if($SQL){
		echo "1";
	}
	mysql_close($conexion);
}
?>