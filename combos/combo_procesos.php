<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select * from procesos  ORDER BY proceso ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_proceso"=>$fila[0],"proceso"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>