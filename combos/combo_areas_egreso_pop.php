<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select * from areas  ORDER BY area  ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_area"=>$fila[0],"area"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>