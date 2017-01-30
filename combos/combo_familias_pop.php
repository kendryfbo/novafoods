<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select id_familia,familia from familias where id_sector_producto=3 ORDER BY familia ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_familia"=>$fila[0],"familia"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>