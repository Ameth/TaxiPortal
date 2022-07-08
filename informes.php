<?php 
require('conexion.php');
//include('GoogChart.class.php');
//require_once ('jpgraph/jpgraph.php');
//require_once ('jpgraph/jpgraph_bar.php');
$sw=0;
if((isset($_POST['Desde']))&&(isset($_POST['Hasta']))){
	$Desde=$_POST['Desde'];
	$Hasta=$_POST['Hasta'];
	$Consulta_CantMovil="SELECT Id_Movil, Count(*) as Cant FROM Recibo Where Fecha Between '$Desde' And '$Hasta' Group by Id_Movil";
	$Consulta_CantDia="SELECT Fecha, Count(*) as Cant FROM Recibo Where Fecha Between '$Desde' And '$Hasta' group by Fecha";
	$Consulta_CantHora="Select DATE_FORMAT(Hora, '%H') as Hora1, Count(*) as Cant From Recibo Where Fecha Between '$Desde' and '$Hasta' Group by Hora1";
	$Consulta_Barrio="SELECT (Select Nombre From Barrios b Where b.Id_Barrio=a.Id_Barrio) as Nombre1, count(*) as Cant FROM Recibo a WHERE Fecha Between '$Desde' And '$Hasta' Group by Nombre1";
	$Consulta_Precio="SELECT Fecha, SUM(Valor) as Valor FROM Recibo Where Fecha Between '$Desde' and '$Hasta' Group by Fecha";
	$SQL_CantMovil=mysql_query($Consulta_CantMovil,$conexion);
	$SQL_CantDia=mysql_query($Consulta_CantDia,$conexion);
	$SQL_CantHora=mysql_query($Consulta_CantHora,$conexion);
	$SQL_Barrio=mysql_query($Consulta_Barrio,$conexion);
	$SQL_Precio=mysql_query($Consulta_Precio,$conexion);
	$sw=1;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script language="JavaScript" type="text/javascript" src="codigo.js"></script>
<!--Calendario Inicio -->
	<link href="Jquery/css/south-street/jquery-ui-1.10.3.custom.css" rel="stylesheet">
	<script src="Jquery/js/jquery-1.9.1.js"></script>
	<script src="Jquery/js/jquery-ui-1.10.3.custom.js"></script>
    <script>
	  $(function() {
		$( "#datepicker" ).datepicker(
		$.extend(
		$.datepicker.regional['es'],
		{
		defaultDate:7,
		dateFormat:"yy-mm-dd",
		showOn:"both"
		}
		)
		);  
	  });
	 </script>
    <script>
	  $(function() {
		$( "#datepicker2" ).datepicker(
		$.extend(
		$.datepicker.regional['es'],
		{
		defaultDate:7,
		dateFormat:"yy-mm-dd",
		showOn:"both"
		}
		)
		);  
	  });
	 </script>
<!--   Calendario Fin -->
<head>
<meta http-equiv="Content-Type" content="text/plain; charset=utf-8" />
<title>Generar Informes</title>
<link href="estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="contenido">
<div id="logo" align="center"></div>
<div id="datos">
<form name="form" action="informes.php" method="post">
<table width="100%">
  <tr>
    <td colspan="2" class="Titulo1"><img src="inf_logo.jpg" width="250" height="248"  alt=""/></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle" class="Titulo1">GENERAR INFORMES</td>
  </tr>
  <tr>
    <td colspan="2"><table width="40%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="18%" class="TextFormat1">Desde:</td>
        <td width="33%" style="font-size:65%"><input type="text" size="7" name="Desde" id="datepicker" value="<?php if($sw==1){echo $Desde;}else{echo date('Y-m-d');} ?>" /></td>
        <td width="17%" class="TextFormat1">Hasta:</td>
        <td width="32%" style="font-size:65%"><input type="text" size="7" name="Hasta" id="datepicker2" value="<?php if($sw==1){echo $Hasta;}else{echo date('Y-m-d');} ?>" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
  <td width="78%"><input name="button" type="submit" class="boton1" id="button" value="Mostrar" /></td>
  <td width="22%"><input name="button2" type="button" class="boton2" id="button2" value="Regresar" onclick="location.href='index.php'" /></td>
  </tr>
  <?php if($sw==1){?>
  <tr>
    <td colspan="2">
    <table width="100%" cellpadding="0" cellspacing="0">
      <tr class="TablaDatos1">
        <td>Total Servicios</td>
      </tr>
      <tr>
        <td>
        <table width="197" border="1" cellpadding="0" cellspacing="0" class="TablaBorde1">
              <tr class="TablaTitulo1">
                <td width="57%" align="center" valign="middle">Fecha</td>
                <td width="43%" align="center" valign="middle">Servicios</td>
              </tr>
                <?php 
		while($row_CantDia=mysql_fetch_array($SQL_CantDia)){
		?>  
              <tr class="Contenido1">
                <td align="center"><?php echo $row_CantDia[0]; ?></td>
                <td align="right"><?php echo $row_CantDia[1]; ?></td>
              </tr>
         <?php }?>
        </table>
       </td>
      </tr>
      </table></td>
  </tr>
  <tr><td colspan="2">&nbsp;</td></tr>  
  <tr>
    <td colspan="2">
    <table width="100%" cellpadding="0" cellspacing="0">
      <tr class="TablaDatos1">
        <td>Total Valor Servicios</td>
      </tr>
      <tr>
        <td>
        <table width="208" border="1" cellpadding="0" cellspacing="0" class="TablaBorde1">
              <tr class="TablaTitulo1">
                <td width="57%" align="center" valign="middle">Fecha</td>
                <td width="43%" align="center" valign="middle">Valor Total</td>
              </tr>
                <?php 
		while($row_Precio=mysql_fetch_array($SQL_Precio)){
		?>  
              <tr class="Contenido1">
                <td align="center"><?php echo $row_Precio[0]; ?></td>
                <td align="right"><?php echo "$".number_format($row_Precio[1],0); ?></td>
              </tr>
         <?php }?>
        </table>
       </td>
      </tr>
      </table></td>
  </tr>
  <tr><td colspan="2">&nbsp;</td></tr>
  <tr>
    <td colspan="2">
    <table width="100%" cellpadding="0" cellspacing="0">
      <tr class="TablaDatos1">
        <td>Servicios por Hora</td>
      </tr>
      <tr>
        <td>
        <table width="180" border="1" cellpadding="0" cellspacing="0" class="TablaBorde1">
              <tr class="TablaTitulo1">
                <td width="52%" align="center" valign="middle">Hora (24 h)</td>
                <td width="48%" align="center" valign="middle">Servicios</td>
              </tr>
                <?php 
		while($row_CantHora=mysql_fetch_array($SQL_CantHora)){
		?>  
              <tr class="Contenido1">
                <td align="center"><?php echo $row_CantHora[0]; ?></td>
                <td align="right"><?php echo $row_CantHora[1]; ?></td>
              </tr>
         <?php }?>
        </table>
       </td>
      </tr>
      </table></td>
  </tr>
  <tr><td colspan="2">&nbsp;</td></tr>
  <tr>
    <td colspan="2">
    <table width="100%" cellpadding="0" cellspacing="0">
      <tr class="TablaDatos1">
        <td>Servicios por Movil</td>
      </tr>
      <tr>
        <td>
        <table width="143" border="1" cellpadding="0" cellspacing="0" class="TablaBorde1">
              <tr class="TablaTitulo1">
                <td width="46%" align="center" valign="middle">Movil</td>
                <td width="54%" align="center" valign="middle">Servicios</td>
              </tr>
                <?php 
		while($row_CantMovil=mysql_fetch_array($SQL_CantMovil)){
		?>  
              <tr class="Contenido1">
                <td align="center"><?php echo $row_CantMovil[0]; ?></td>
                <td align="right"><?php echo $row_CantMovil[1]; ?></td>
              </tr>
         <?php }?>
        </table>
       </td>
      </tr>
      </table></td>
  </tr>
  <tr><td colspan="2">&nbsp;</td></tr>
  <tr>
    <td colspan="2">
    <table width="100%" cellpadding="0" cellspacing="0">
      <tr class="TablaDatos1">
        <td>Servicios por Barrio</td>
      </tr>
      <tr>
        <td>
        <table width="368" border="1" cellpadding="0" cellspacing="0" class="TablaBorde1">
              <tr class="TablaTitulo1">
                <td width="74%" align="center" valign="middle">Nombre Barrio</td>
                <td width="26%" align="center" valign="middle">Servicios</td>
              </tr>
                <?php 
		while($row_Barrio=mysql_fetch_array($SQL_Barrio)){
		?>  
              <tr class="Contenido1">
                <td align="center"><?php echo $row_Barrio[0]; ?></td>
                <td align="right"><?php echo $row_Barrio[1]; ?></td>
              </tr>
         <?php }?>
        </table>
       </td>
      </tr>
      </table></td>
  </tr>
  <?php }?>
  <tr>
    <td colspan="2"><table width="100%" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2">&nbsp;</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="22%">&nbsp;</td>
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