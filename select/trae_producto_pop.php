<?php
	$id_prod_pop=$_GET["id_prod_pop"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 
	 $sql1="select 
			codigo_producto,
			nombre_producto
			from productos
			WHERE id_producto =".$id_prod_pop;
 		 	
	$ejecuta=mysql_query($sql1,$conexion->link);

	while ($fila = mysql_fetch_array($ejecuta))
	{
		$salida[]=array("codigo_producto"=>utf8_encode($fila[0]),"nombre_producto"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);
	 
		 


?>