<?php	 
	include_once("../clases/conexion.php");
 	$conexion=new conexion();
	$sql="select id_cliente,nombre from cliente where tipo_cliente=1 ORDER BY nombre ASC";
	//$sql="select id_cliente,nombre_cliente from cliente_internacional ORDER BY nombre_cliente ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_cliente"=>$fila[0],"nombre"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>