<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql=" select id_sabor,sabor_espanol from sabores where sabor_espanol <> ''  ORDER BY sabor_espanol ASC ";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_sabor"=>$fila[0],"sabor"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>