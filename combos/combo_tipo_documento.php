<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select * from tipo_de_documento ORDER BY tipo_documento ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_tipo_documento"=>$fila[0],"tipo_documento"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>