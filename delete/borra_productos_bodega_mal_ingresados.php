<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=$_POST["funcion"];

	if ($funcion==1)
	{
		$id_pedido_orden_compra=$_POST["id_pedido_orden_compra"];
 		try{
			 	$sql="DELETE FROM temporal_detalle_productos_orden_compra	
				WHERE id_pedido_orden_compra=".$id_pedido_orden_compra;

				$resultado=mysql_query($sql,$conexion->link);
			}
				catch (Exception $e)
			{  
				echo $e->getMessage();
			}	
	}
	else if ($funcion==2)
	{
		$id_pedido_orden_compra=$_POST["id_pedido_orden_compra"];
 		try{
			 	$sql="DELETE FROM detalle_productos_orden_compra	
				WHERE id_pedido_orden_compra=".$id_pedido_orden_compra;

				$resultado=mysql_query($sql,$conexion->link);
			}
				catch (Exception $e)
			{  
				echo $e->getMessage();
			}	
	}


				
?>