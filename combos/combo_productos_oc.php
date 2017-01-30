<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select id_producto,nombre_producto from productos where id_sector_producto<>4  ORDER BY nombre_producto ASC";
	//	$sql="select id_producto,nombre_producto from productos where id_sector_producto=4 ORDER BY nombre_producto ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_producto"=>$fila[0],"nombre_producto"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>