<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select * from region_cl";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_re"=>$fila[0],"str_descripcion"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>