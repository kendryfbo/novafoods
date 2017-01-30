<?php
	$id_familia_mprima=trim($_POST["id_familia_mprima"]);
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 
	 $sql1="select crl from familias
			WHERE id_familia=".$id_familia_mprima; 		 	
	$ejecuta=mysql_query($sql1,$conexion->link);
	while ($fila = mysql_fetch_array($ejecuta))
	{
		$crl=$fila[0]+1;
	}
	//echo json_encode($salida);
	echo $crl;
		 


?>