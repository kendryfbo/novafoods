<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$altillo=trim($_POST["altillo"]);
	$id_posicion_bodega=trim($_POST["id_posicion_bodega"]);
 
 		 
		$sql3="INSERT INTO altillos (id_altillo,sector_altillo)
					VALUES ('$altillo','$id_posicion_bodega')";
					$resultado=mysql_query($sql3,$conexion->link);
	
					
?>		