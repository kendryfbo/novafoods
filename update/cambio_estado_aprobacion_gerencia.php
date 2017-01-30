<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$num_orden_compra=$_POST["num_orden_compra"];

	try{
			$sql="SELECT id_area  FROM orden_compra where numero_orden_compra=".$num_orden_compra;
			$ejecuta=mysql_query($sql,$conexion->link);
			$mensaje=mysql_fetch_array($ejecuta);
				
			 
			$sql1="UPDATE orden_compra	 
				set 		 
				id_estado_orden_compra=5
				where numero_orden_compra=".$num_orden_compra;
			$resultado2=mysql_query($sql1,$conexion->link);
					
			$sql1="UPDATE detalle_productos_orden_compra	 
			set 		 
			id_estado_producto=13
			where numero_orden_compra=".$num_orden_compra;
			$resultado2=mysql_query($sql1,$conexion->link);
			
			echo "Orden de Compra Aprobada";
			
		
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		