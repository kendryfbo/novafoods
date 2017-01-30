<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select id_marca,marca from marcas  ORDER BY marca ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_marca"=>$fila[0],"marca"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>