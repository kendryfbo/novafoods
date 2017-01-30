<?php
	$id_umed=$_GET["id_umed"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 
	 $sql1="select * from umed 
			WHERE id_umed =".$id_umed;
 		 	
	$ejecuta=mysql_query($sql1,$conexion->link);

	while ($fila = mysql_fetch_array($ejecuta))
	{
		$salida[]=array("umed"=>$fila[1]);
	}
	echo json_encode($salida);
	 
		 


?>