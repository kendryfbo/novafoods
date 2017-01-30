<?php
	$cantidad=$_POST["cantidad"];
	$id_pedido=$_POST["id_pedido"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select 
			cantidad_faltante	
			from detalle_productos_orden_compra
			where id_pedido_orden_compra=".$id_pedido;
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
			if ($fila = mysql_fetch_array($ejecuta))
			{
				if ($cantidad>$fila[0])
				{
				
					echo "Error";
				}
				else
				{
					echo "ok";
				}
			}
		 
?>