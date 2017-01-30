<?php
	$id_aduana=$_GET["id_aduana"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$sql1="select * from aduanas 
	WHERE id_aduana =".$id_aduana;
 	$ejecuta=mysql_query($sql1,$conexion->link);
	while ($fila = mysql_fetch_array($ejecuta))
	{
		$salida[]=array("nombre_aduana"=>$fila[1],"rut"=>$fila[2],"direccion"=>$fila[3],"ciudad"=>$fila[4],"fono"=>$fila[1]);
	}
	echo json_encode($salida);
?>