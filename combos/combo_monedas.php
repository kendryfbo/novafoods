<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select * from moneda  ORDER BY tipo_moneda ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_moneda"=>$fila[0],"moneda"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>