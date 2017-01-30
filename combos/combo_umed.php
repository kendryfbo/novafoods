<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select id_umed,umed from umed ORDER BY umed ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_umed"=>$fila[0],"umed"=>$fila[1]);

	}
	echo json_encode($salida);


?>