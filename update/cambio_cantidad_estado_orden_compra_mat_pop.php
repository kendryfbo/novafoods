<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$valor_nuevo=$_POST["valor_nuevo"];
 	$num_orden_compra=trim($_POST["num_orden_compra"]);
 	$id_bodega=trim($_POST["id_bodega"]);
	
	try{
			$sql="select id_producto,cantidad,numero_documento,fecha_movimiento,id_tipo_documento from calidad where id_bodega=".$id_bodega;	 
			$resultado=mysql_query($sql,$conexion->link);
			while ($fila = mysql_fetch_array($resultado))
			{	
				$sql4="select cantidad_faltante,id_pedido_orden_compra,id_producto from detalle_productos_orden_compra where id_producto=".$fila[0]. " and numero_orden_compra=".$num_orden_compra;
				$resultado4=mysql_query($sql4,$conexion->link);
				while ($fila4 = mysql_fetch_array($resultado4))
				{	
				
					$cantidad_faltante=($fila[1]-$valor_nuevo);
					$valor_faltante=($fila4[0]+$cantidad_faltante);
					$sql1="UPDATE detalle_productos_orden_compra	 
					set 		 
					cantidad_faltante='".$valor_faltante."',
					id_estado_producto=13
					where id_producto=".$fila[0]. " and numero_orden_compra=".$num_orden_compra;
					$resultado1=mysql_query($sql1,$conexion->link);

					$sql2="UPDATE orden_compra	 
					set 		 
					id_estado_orden_compra=5
					where numero_orden_compra=".$num_orden_compra;
					$resultado2=mysql_query($sql2,$conexion->link);

					$sql6="INSERT INTO calidad (id_pedido_orden_compra,id_producto,cantidad,numero_documento,fecha_movimiento,id_tipo_documento,numero_orden_compra,rechazada)
					VALUES ('$fila4[1]','$fila4[2]','$cantidad_faltante','$fila[2]','$fila[3]','$fila[4]','$num_orden_compra','si')";
					$resultado6=mysql_query($sql6,$conexion->link);
					
					$sql3="UPDATE calidad	 
					set 		 
					cantidad=".$valor_nuevo." where id_bodega=".$id_bodega;
					$resultado3=mysql_query($sql3,$conexion->link);
				}			
			}
	
		
		
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		