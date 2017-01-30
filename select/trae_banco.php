<?php
	$id_banco=$_GET["id_banco"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$sql1="select * from bancos 
	WHERE id_banco =".$id_banco;
 	$ejecuta=mysql_query($sql1,$conexion->link);
	while ($fila = mysql_fetch_array($ejecuta))
	{
		$salida[]=array("banco"=>$fila[1]);
	}
	echo json_encode($salida);
?>