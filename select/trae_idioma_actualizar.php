<?php
	$id_idioma=$_GET["id_idioma"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 
	 $sql1="select * from idiomas 
			WHERE id_idioma =".$id_idioma;
 		 	
	$ejecuta=mysql_query($sql1,$conexion->link);

	while ($fila = mysql_fetch_array($ejecuta))
	{
		$salida[]=array("idioma"=>utf8_encode($fila[1]));
	}
	echo json_encode($salida);
	 
		 


?>