<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
    $numero_codigo_barra=trim($_POST["numero_codigo_barra"]);
	
	$sql="select id from detalle_veredas
						where id=".$numero_codigo_barra;
	$resultado=mysql_query($sql,$conexion->link);
	$mensaje = mysql_fetch_array ($resultado);
	if ($mensaje[0]<>"")
	{
		echo "Ok";	
	}
	else
	{
		echo "Error";
	}
?>	
	