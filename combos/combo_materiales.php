<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select * from materiales  ORDER BY material ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_material"=>$fila[0],"material"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>