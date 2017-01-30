<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$valor_faltante=$_POST["valor_faltante"];
	$valor_ingresado=$_POST["valor_ingresado"];
 	$id_pedido=trim($_POST["id_pedido"]);
 
	try{
			$sql1="UPDATE detalle_productos_orden_compra	 
				set 		 
				cantidad_faltante=".$valor_faltante.",
				cantidad_ingresa=".$valor_ingresado. "
				where id_pedido_orden_compra=".$id_pedido;
			$resultado2=mysql_query($sql1,$conexion->link);
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		