<?php
	$id_formato=trim($_POST["id_formato"]);
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 
	 $sql1="select sobre from formatos 
			WHERE id_formato =".$id_formato;
 		 	
	$ejecuta=mysql_query($sql1,$conexion->link);

	while ($fila = mysql_fetch_array($ejecuta))
	{
		$dis=$fila[0];
	}
	//echo json_encode($salida);
	echo $dis;
		 


?>