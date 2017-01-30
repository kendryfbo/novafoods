<?php	 
	include_once("../clases/conexion.php");
 	$conexion=new conexion();
	$sql="select id_giro,giro from giros  ORDER BY giro ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_giro"=>$fila[0],"giro"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>