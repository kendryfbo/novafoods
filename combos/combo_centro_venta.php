<?php	 
	include_once("../clases/conexion.php");
 	$conexion=new conexion();
	$sql="select * from centro_venta ORDER BY centro_venta ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_centro_venta"=>$fila[0],"centro_venta"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>