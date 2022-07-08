<?php 
if($_POST['P']!=""){
	require('conexion.php');
if($_POST['P']==1){
	$Consulta="INSERT INTO Cliente
	VALUES (
	'".$_POST['ID']."'
	,'".utf8_decode($_POST['Nombre'])."'
	,'".$_POST['Cedula']."'
	,'".utf8_decode($_POST['DireccionCasa'])."'
	,'".utf8_decode($_POST['DireccionCobro'])."'
	,'".$_POST['Telefono']."'
	,'".utf8_decode($_POST['Recomendado'])."'
	,'".utf8_decode($_POST['Observaciones'])."')";
	if(mysql_query($Consulta,$conexion)){
		mysql_close($conexion);
		header('Location:nuevo_cliente.php?a='.base64_encode('agregado'));		
		}else{
			echo "No se pudo registrar el Cliente";
			echo $Consulta;
			mysql_close($conexion);
			}	
}	
if($_POST['P']==2){
	$Consulta="INSERT INTO Credito
	VALUES (
	'".$_POST['ID']."'
	,'".$_POST['Obligacion']."'
	,'1'
	,'".$_POST['ValorCredito']."'
	,'".$_POST['PlazoCredito']."'
	,'".$_POST['InteresCredito']."'
	,'".$_POST['ValorCuota']."'
	,'".$_POST['FechaCredito']."'
	,'".$_POST['FechaVencimiento']."')";
	if(mysql_query($Consulta,$conexion)){
		mysql_close($conexion);
		header('Location:list_credito_cliente.php?ID='.$_POST['ID']);		
		}else{
			echo "No se pudo registrar el Crédito";
			echo $Consulta;
			mysql_close($conexion);
			}	
}
	
	
	




}


?>