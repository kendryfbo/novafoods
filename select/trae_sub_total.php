<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);
	if ($funcion==1)
	{
		$numero_orden_compra=trim($_POST["numero_orden_compra"]);
		$sql="select sum(total) as suma
			from detalle_productos_orden_compra
			where numero_orden_compra=".$numero_orden_compra;				
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
		echo  $mensaje[0]; 
	}
	else if ($funcion==2)
	{
		$numero_orden_compra=trim($_POST["numero_orden_compra"]);
		$sql="select sum(total) as suma
			from temporal_detalle_productos_orden_compra
			where numero_orden_compra=".$numero_orden_compra;				
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
		echo  $mensaje[0]; 
	}
 			
?>	