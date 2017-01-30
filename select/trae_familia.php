<?php
	$id_familia=$_GET["id_familia"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 
	 $sql1="select * from familias 
			WHERE id_familia =".$id_familia;
 		 	
	$ejecuta=mysql_query($sql1,$conexion->link);

	while ($fila = mysql_fetch_array($ejecuta))
	{
		$salida[]=array("codigo_familia"=>$fila[1],"familia"=>$fila[2]);

	}
	echo json_encode($salida);
	 
		 


?>