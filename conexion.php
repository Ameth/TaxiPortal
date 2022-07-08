<?php 
date_default_timezone_set('America/Bogota');
$usuario='root';
$contrasena='mA62znYaEACtv4wm';
$servidor='localhost';
$conexion=mysql_connect($servidor,$usuario,$contrasena);
mysql_select_db("taxiportal",$conexion);
?>