<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select * from categoria  ORDER BY categoria ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_categoria"=>$fila[0],"categoria"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>