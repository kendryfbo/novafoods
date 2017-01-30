<?php	 
	include_once("../clases/conexion.php");
 	$conexion=new conexion();
	$sql="select * from referencia ORDER BY id_referencia ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_referencia"=>$fila[0],"referencia"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>