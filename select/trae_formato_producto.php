<?php
	$id_producto_terminado=trim($_POST["id_producto_terminado"]);
	include_once("../clases/conexion.php");
	$conexion= new conexion();
        
	$sql1="select id_formato from productos 
	WHERE id_producto =".$id_producto_terminado;
 	$ejecuta=mysql_query($sql1,$conexion->link);
	while ($fila = mysql_fetch_array($ejecuta))
	{
		$id_formato=$fila[0];
	}
	echo $id_formato;
?>