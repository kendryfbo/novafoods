<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();
	$sql="select * from cargos  ORDER BY cargo ASC";
	$ejecuta=mysql_query($sql,$conexion->link);	 
	while ($fila = mysql_fetch_array($ejecuta))
	{	
		$salida[]=array("id_cargo"=>$fila[0],"cargo"=>utf8_encode($fila[1]));
	}
	echo json_encode($salida);
?>