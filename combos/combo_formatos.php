<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select id_formato,formato from formatos  ORDER BY formato ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_formato"=>$fila[0],"formato"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>