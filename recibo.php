<?php 
require('conexion.php');
if(isset($_GET['Barrio'])&&isset($_GET['Movil'])){
	$Barrio=$_GET['Barrio'];
	$Movil=$_GET['Movil'];
	//Extraer datos de Barrio
	$Consulta1="Select * From Barrios Where Id_Barrio=$Barrio";
	$SQL1=mysql_query($Consulta1,$conexion);
	//Extraer datos del Movil
	$Consulta2="Select * From Movil Where Id_Movil=$Movil";
	$SQL2=mysql_query($Consulta2,$conexion);	
	if(($SQL1)&&($SQL2)){
		$row1=mysql_fetch_assoc($SQL1);
		$row2=mysql_fetch_assoc($SQL2);	
		$Num2=mysql_num_rows($SQL2);
		$Id_Recibo=date('YmdHi').substr(uniqid(rand()),0,4);
		}
	if(isset($Num2)&&($Num2>=1)){
		if(date('H')>=22||date('H')<6){
			$row1['Tarifa']=$row1['Tarifa']+1000;
		}
?>
<!doctype html>
<html>
<head>
<script>
window.onbeforeprint= function(){
	document.getElementById('button').style.visibility='hidden';
	}
window.onafterprint= function(){
	document.getElementById('button').style.visibility='visible';
	}
</script>
<script src="Jquery/js/jquery-1.9.1.js"></script>
<style media="print">
input{display:none;}
</style>
<meta charset="utf-8">
<title>Imprimir Ticket</title>
<link href="estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="230" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" valign="middle" class="Texto1">TRANSPORTAL DEL CARIBE S.A.S</td>
      </tr>
      <tr>
        <td align="center" valign="middle" class="Texto1">¡Con nuestro corazón al volante!</td>
      </tr>
      <tr>
        <td align="center" valign="middle" class="Texto1">PBX: 3199999</td>
      </tr>
      <tr>
        <td align="center" valign="middle" class="Texto1">NIT. 900.431.701-9</td>
      </tr>
      <tr>
        <td align="center" valign="middle" class="Texto1">¡BIENVENIDOS!</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" valign="middle">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" class="Texto2">Número de recibo: </td>
        <td width="50%" class="Texto2"><?php echo $Id_Recibo; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" class="Texto2">Fecha:</td>
        <td width="50%" class="Texto2"><?php echo date('Y-m-d');?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" class="Texto2">Hora:</td>
        <td width="50%" class="Texto2"><?php echo date('g:i a');?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="middle" class="Texto2">CONDUCTOR</td>
      </tr>
      <tr>
        <td align="center" valign="middle" class="Texto5"><?php echo utf8_encode($row2['NombreConductor']); ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" class="Texto2">Movil:</td>
        <td width="50%" class="Texto2"><?php echo $row2['Id_Movil']; ?></td>
      </tr>
      <tr>
        <td class="Texto2">Placa:</td>
        <td class="Texto2"><?php echo $row2['PlacaVehiculo']; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" class="Texto2">Origen:</td>
        <td width="50%" class="Texto2">CC PORTAL PRADO</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" class="Texto2">Barrio de Destino:</td>
        <td width="50%" class="Texto2"><?php echo $row1['Nombre']; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" class="Texto3">Tarifa:</td>
        <td width="50%" class="Texto3"><?php echo "$ ".number_format($row1['Tarifa'],0); ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="middle" class="Texto4">Estas son tarifas propuestas para los servicios desde el Centro Cemercial Portal del Prado. Corresponden al valor MAXIMO permitido que puede cobrarse por el servicio. Cualquier inquietud comuniquese al 3199999 o escriba a servicioalcliente@taxiportal.com.co</td>
      </tr>
      <tr>
        <td align="center" valign="middle" class="Texto4">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="middle" class="Texto4">Gracias por utilizar nuestros servicios</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="middle"><input name="button" type="button" class="boton2" id="button" value="Imprimir"><input name="Id_Recibo" type="hidden" id="Id_Recibo" value="<?php echo $Id_Recibo;?>"><input name="Id_Barrio" type="hidden" id="Id_Barrio" value="<?php echo $row1['Id_Barrio']; ?>"><input name="Id_Movil" type="hidden" id="Id_Movil" value="<?php echo $row2['Id_Movil']; ?>"><input name="Fecha" type="hidden" id="Fecha" value="<?php echo date('Y-m-d');?>"><input name="Hora" type="hidden" id="Hora" value="<?php echo date('H:i:s');?>"><input name="Valor" type="hidden" id="Valor" value="<?php echo $row1['Tarifa'];?>"></td>
  </tr>
</table>
</body>
</html>
<script type="text/javascript">
var Recibo=document.getElementById("Id_Recibo").value;
var Barrio=document.getElementById("Id_Barrio").value;
var Movil=document.getElementById("Id_Movil").value;
var Fecha=document.getElementById("Fecha").value;
var Hora=document.getElementById("Hora").value;
var Valor=document.getElementById("Valor").value;
$('#button').click(function(){
$.ajax({
	type:"POST",
	url:"registrar_recibo.php",
	data:"Id_Recibo="+Recibo+"&Id_Barrio="+Barrio+"&Id_Movil="+Movil+"&Fecha="+Fecha+"&Hora="+Hora+"&Valor="+Valor,
	success: function(resp){
		if(resp==1){
			window.print();
			}
		}
	});
});
</script>
<?php 
	}else{
		echo "<font face=\"tahoma\" size=\"2\" color=\"red\"><b>No existe el Movil: ".$_GET['Movil']."</b></font>";
		}
}
mysql_close($conexion);
?>