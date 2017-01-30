<?php
	$numero_orden=$_POST["numero_orden"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select 
			numero_orden_compra
			from orden_compra
			where orden_compra.numero_orden_compra=".$numero_orden. " and id_estado_orden_compra <> 7";
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
 			$fila=mysql_fetch_array($ejecuta);
			if ($fila<>"")
			{
				echo $fila[0];
			  
			}
			else
			{
		 		echo "Error";
				 
			}
				
?>