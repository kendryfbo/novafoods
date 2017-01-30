<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select * from colores  ORDER BY color ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_color"=>$fila[0],"color"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>