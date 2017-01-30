<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select * from paises ORDER BY pais ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_pais"=>$fila[0],"pais"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>