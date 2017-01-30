<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select id_tipo_producto,tipo_producto from tipo_producto sector ORDER BY tipo_producto ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_tipo"=>$fila[0],"tipo"=>$fila[1]);

	}
	echo json_encode($salida);


?>