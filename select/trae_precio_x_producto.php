<?php
	$id_producto=$_POST["id_producto"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select 
			productos.costo_unitario,
			umed.umed
			from productos
			inner join umed on umed.id_umed=productos.id_umed
			where productos.id_producto=".$id_producto;
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
 
 
			if ($fila = mysql_fetch_array($ejecuta))
			{
			 
				$salida[]=array("costo_unitario"=>$fila[0],"umed"=>utf8_encode($fila[1]));
			
			}
				echo json_encode($salida);
		 
?>