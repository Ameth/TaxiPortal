<?php 
if(!isset($_GET['ID_Barrio'])||($_GET['ID_Barrio']=="")){echo ""; exit();}else{
	require('conexion.php');
	$ID=$_GET['ID_Barrio'];
	$Consulta="Select Tarifa From Barrios Where ID_Barrio='$ID'";
	$SQL=mysql_query($Consulta,$conexion);
	$Num=mysql_num_rows($SQL);
	$row=mysql_fetch_assoc($SQL);
	if($Num==1){
		if(date('H')>=22||date('H')<6){
			$row['Tarifa']=$row['Tarifa']+1000;
		}
		echo "<font face=\"tahoma\" size=\"4\">$ ".number_format($row['Tarifa'],0)."</font>";
	}else{
		echo "";
	}
	mysql_close($conexion);
}
//echo "Mostrar";
?>