<?php
	$id_color=$_GET["id_color"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$sql1="select * from colores 
	WHERE id_color =".$id_color;
 	$ejecuta=mysql_query($sql1,$conexion->link);
	while ($fila = mysql_fetch_array($ejecuta))
	{
		$salida[]=array("color"=>$fila[1]);
	}
	echo json_encode($salida);
?>