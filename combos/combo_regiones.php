<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select id_region,region from regiones  ORDER BY region ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_region"=>$fila[0],"region"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>