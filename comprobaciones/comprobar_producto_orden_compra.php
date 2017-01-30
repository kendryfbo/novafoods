<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
  	$numero_orden_compra=trim($_POST["numero_orden_compra"]);
	$id_producto=trim($_POST["id_producto"]);
	$funcion=trim($_POST["funcion"]);
	
	if ($funcion==1)
	{
		$sql1="select id_producto from detalle_productos_orden_compra
				where numero_orden_compra='".$numero_orden_compra."' and id_producto = ".$id_producto;
		$resultado=mysql_query($sql1,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
		
		if ($mensaje[0]<>"")
		{
			echo "Error";
			return false;

		}
		else
		{
				echo "Ok";
		}		
	}
	else if ($funcion==2)
	{
		$sql1="select id_producto from temporal_detalle_productos_orden_compra
				where numero_orden_compra='".$numero_orden_compra."' and id_producto = ".$id_producto;
		$resultado=mysql_query($sql1,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
		
		if ($mensaje[0]<>"")
		{
			echo "Error";
			return false;

		}
		else
		{
				echo "Ok";
		}

	}
	
?>	