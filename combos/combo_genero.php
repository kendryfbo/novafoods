<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select * from generos  ORDER BY genero ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_genero"=>$fila[0],"genero"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>