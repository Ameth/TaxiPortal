<?php 
require('conexion.php');
$Consulta="Select * from Barrios";
$Consulta2="Select * from Movil";
$SQL=mysql_query($Consulta,$conexion);
$SQL2=mysql_query($Consulta2,$conexion);
if(($SQL)&&($SQL2)){
	$Num=mysql_num_rows($SQL);
	$Num2=mysql_num_rows($SQL2);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script language="JavaScript" type="text/javascript" src="codigo.js"></script>
<script>
function recibo(barrio,movil)
{
	self.name='opener';
	var posicion_x;  
	var posicion_y;  
	posicion_x=(screen.width-500)/2;  
	posicion_y=(screen.height-500)/2;
	if((barrio!="")&&(movil!="")){
		remote=open('recibo.php?Barrio='+barrio+'&Movil='+movil,'remote',"width=250,height=530,location=no,scrollbars=no,menubars=no,toolbars=no,resizable=no,fullscreen=no,directories=no,status=yes,left="+posicion_x+",top="+posicion_y+"");
		remote.focus();
	}
	}
</script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Generar Servicio de Taxi</title>
<link href="estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="contenido">
<div id="logo" align="center"><img alt="Logo" src="logo.png" width="500" height="250" /></div>
<div id="datos">
<form name="form" action="" method="post">
<table width="100%">
  <tr>
    <td align="right"><input name="Informes" type="button" class="boton2" id="Informes" value="Ver Informes" onclick="location.href='informes.php'" /></td>
  </tr>
  <tr>
    <td class="TablaTitulo1">Generar Servicio - Taxi Portal</td>
    </tr>
  <tr>
    <td><table width="100%" cellpadding="0" cellspacing="0">
      <tr class="TablaDatos1">
        <td width="23%">Barrio</td>
        <td width="16%">Tipo de Zona</td>
        <td width="12%">Tarifa</td>
        <td width="32%">Movil</td>
      </tr>
      <tr>
        <td><?php if($Num>0){?><select name="Barrio" id="Barrio" onchange="llamarasincrono('zonaroja.php?ID_Barrio='+document.form.Barrio.value,'ZonaRoja');llamarasincrono('tarifa.php?ID_Barrio='+document.form.Barrio.value,'Tarifa');">
          <option value="" selected="selected">Seleccione...</option>
        <?php
			while($row=mysql_fetch_assoc($SQL)){
				echo "<option value=\"".$row['Id_Barrio']."\">".utf8_encode($row['Nombre'])."</option>";
			}
		?>
          </select><?php }?></td>
        <td align="center"><div id="ZonaRoja"></div></td>
        <td><div id="Tarifa"></div></td>
        <td colspan="2"><?php if($Num2>0){?><select name="Movil" id="Movil">
          <option value="" selected="selected">...</option>
        <?php
			while($row2=mysql_fetch_assoc($SQL2)){
				echo "<option value=\"".$row2['Id_Movil']."\">".$row2['Id_Movil']."</option>";
			}
		?>
          </select><?php }?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" cellpadding="0" cellspacing="0">
      <tr>
        <td width="22%"><input name="button" type="button" class="boton1" id="button" value="Generar recibo" onclick="javascript:recibo(document.form.Barrio.value,document.form.Movil.value)" /></td>
        <td width="78%">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</div>
</div>
</body>
</html>
<?php mysql_close($conexion);?>