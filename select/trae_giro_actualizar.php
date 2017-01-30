<?php
	$id_giro=$_GET["id_giro"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 
	 $sql1="select * from giros 
			WHERE id_giro =".$id_giro;
 		 	
	$ejecuta=mysql_query($sql1,$conexion->link);

	while ($fila = mysql_fetch_array($ejecuta))
	{
		$salida[]=array("giro"=>$fila[1]);
	}
	echo json_encode($salida);
	 
		 


?>