<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_bodega=$_POST["id_bodega"];

	
	$sql="UPDATE calidad	 
		set 		 
		aceptada='si'
		where id_bodega=".$id_bodega;
	 
	$resultado1=mysql_query($sql,$conexion->link);
	if (!$resultado1) "Error";
?>