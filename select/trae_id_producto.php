<?php
	$cod_producto_mant=$_POST["cod_producto_mant"];
	 include_once("../clases/conexion.php");
	$conexion=new conexion();
 

	$sql="SELECT MAX(id_producto) AS id FROM productos";
	$ejecuta=mysql_query($sql,$conexion->link);
	$mensaje=mysql_fetch_array($ejecuta);
	
	 $data=$cod_producto_mant.($mensaje[0]+1);
	 echo $data;
?>