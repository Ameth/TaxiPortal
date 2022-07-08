<?php 
if(!isset($_GET['ID_Barrio'])||($_GET['ID_Barrio']=="")){echo ""; exit();}else{
	require('conexion.php');
	$ID=$_GET['ID_Barrio'];
	$Consulta="Select ZonaRoja From Barrios Where ID_Barrio='$ID'";
	$SQL=mysql_query($Consulta,$conexion);
	$row=mysql_fetch_assoc($SQL);
	if($row['ZonaRoja']==1){
		echo "<font face=\"tahoma\" size=\"2\" color=\"red\"><b>ZONA ROJA</b></font>";
	}else{
		echo "<font face=\"tahoma\" size=\"2\" color=\"green\"><b>ZONA NORMAL</b></font>";
	}
	mysql_close($conexion);
}
//echo "Mostrar";
?>