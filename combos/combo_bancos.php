<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();

	$sql="select * from bancos";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{	
		$salida[]=array("id_banco"=>$fila[0],"banco"=>utf8_encode($fila[1]));
	}
	echo json_encode($salida);


?>