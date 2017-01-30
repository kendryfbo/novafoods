<?php
	$id_cargo=$_GET["id_cargo"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 
	 $sql1="select * from cargos 
			WHERE id_cargo =".$id_cargo;
 		 	
	$ejecuta=mysql_query($sql1,$conexion->link);

	while ($fila = mysql_fetch_array($ejecuta))
	{
		$salida[]=array("cargo"=>$fila[1]);
	}
	echo json_encode($salida);
	 
		 


?>