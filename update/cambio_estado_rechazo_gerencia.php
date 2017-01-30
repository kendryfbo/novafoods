<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$num_orden_compra=$_POST["num_orden_compra"];

	try{
			$sql1="UPDATE orden_compra	 
				set 		 
				id_estado_orden_compra=4
				where numero_orden_compra=".$num_orden_compra;

			$resultado2=mysql_query($sql1,$conexion->link);
			
			$sql1="UPDATE detalle_productos_orden_compra	 
				set 		 
				id_estado_producto=12
				where numero_orden_compra=".$num_orden_compra;

			$resultado2=mysql_query($sql1,$conexion->link);
	
			echo "Orden de Compra Rechazada";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		