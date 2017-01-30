<?php
	$id_formato=$_GET["id_formato"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 
	 $sql1="select * from formatos 
			WHERE id_formato =".$id_formato;
 		 	
	$ejecuta=mysql_query($sql1,$conexion->link);

	while ($fila = mysql_fetch_array($ejecuta))
	{
		$salida[]=array("formato"=>$fila[1]);
	}
	echo json_encode($salida);
	 
		 


?>