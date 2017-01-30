<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$id_producto=trim($_POST["id_producto"]);
	$id_proveedor=trim($_POST["id_proveedor"]);
	$lote=trim($_POST["lote"]);
	$cantidad=trim($_POST["cantidad"]);
	$rechazado=trim($_POST["rechazado"]);
	$bloqueado=trim($_POST["bloqueado"]);
 	$numero_reclamo=trim($_POST["numero_reclamo"]);
	$descripcion=trim($_POST["descripcion"]);
	$informante=trim($_POST["informante"]);
	$numero_orden=trim($_POST["numero_orden"]);
	$id_bodega=trim($_POST["id_bodega"]);

	try{		
			mysql_query("SET NAMES 'utf8'");
			$sql="UPDATE formulario_reclamos	 
				set 		 
				id_proveedor='".$id_proveedor."',
				id_producto='".$id_producto."',
				observacion='".utf8_decode($descripcion)."',
				lote='".utf8_decode($lote)."',
				cantidad='".$cantidad."',
				rechazada='".utf8_decode($rechazado)."',
				bloqueado='".utf8_decode($bloqueado)."',
				numero_orden_compra=".$numero_orden."
				where id_reclamo=".$numero_reclamo;

			$resultado=mysql_query($sql,$conexion->link);

			$sql1="select 
			cantidad_faltante,
			id_pedido_orden_compra
			from detalle_productos_orden_compra 
			WHERE numero_orden_compra =".$numero_orden." and id_producto=".$id_producto; 		 	
			$resultado1=mysql_query($sql1,$conexion->link);
			while ($fila1 = mysql_fetch_array($resultado1))
			{
				$cantidad_faltante=$fila1[0]+$cantidad;
				$sql2="UPDATE detalle_productos_orden_compra	 
				set 		 
				cantidad_faltante='".$cantidad_faltante."',
				id_estado_producto=13
				where id_pedido_orden_compra=".$fila1[1];
				$resultado2=mysql_query($sql2,$conexion->link);

				$sql21="UPDATE orden_compra	 
				set 		 
				id_estado_orden_compra=5							 
				where numero_orden_compra=".$numero_orden;
				$resultado21=mysql_query($sql21,$conexion->link);

			}
				$sql4="select 
				cantidad
				from calidad 
				where id_bodega=".$id_bodega;
				$resultado4=mysql_query($sql4,$conexion->link);	
				while ($fila4 = mysql_fetch_array($resultado4))
				{
					$cantidad_faltante2=$fila4[0]-$cantidad;
					$sql3="UPDATE calidad	 
					set 		 
					cantidad=".$cantidad_faltante2."
					where id_bodega=".$id_bodega;
					$resultado3=mysql_query($sql3,$conexion->link);
				}
				$resultado6=mysql_query($sql4,$conexion->link);	
				while ($fila5 = mysql_fetch_array($resultado6))
				{
					if ($fila5[0]==0)
					{	
						$sql5="delete from calidad	 
						where id_bodega=".$id_bodega;
						$resultado5=mysql_query($sql5,$conexion->link);

					}
				}
 
			echo "Reclamo Ingresado";
	
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
 		
?>		