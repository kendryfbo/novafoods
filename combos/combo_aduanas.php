<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select * from aduanas";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_aduana"=>$fila[0],"nombre_aduana"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>