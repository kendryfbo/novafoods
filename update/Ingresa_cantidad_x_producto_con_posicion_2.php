<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_pedido=$_POST["id_pedido"];
 	$cantidad=trim($_POST["cantidad"]);
	$fecha=date("y-m-d H:i:s");
 	$numero_documento=trim($_POST["numero_documento"]);
	$id_tipo_documento=trim($_POST["id_tipo_documento"]);
	$numero_orden_compra=trim($_POST["numero_orden_compra"]);	
	$observacion=trim($_POST["observacion"]);	
	$cantidad_pallet=trim($_POST["cantidad_pallet"]);
	$id_posicion=trim($_POST["id_posicion"]);
 try{
		$sql2="select
		cantidad_faltante
		from detalle_productos_orden_compra
		WHERE id_pedido_orden_compra=".$id_pedido;
		$resultado=mysql_query($sql2,$conexion->link);
		if($mensaje1=mysql_fetch_array($resultado))
		{
			$sql1="UPDATE detalle_productos_orden_compra	 
					set 		 
					cantidad_ingresa='".$cantidad."'
			where id_pedido_orden_compra=".$id_pedido;
			$resultado1=mysql_query($sql1,$conexion->link);
	
			$sql2="select
				detalle_productos_orden_compra.cantidad_ingresa,
				detalle_productos_orden_compra.cantidad_faltante,
				detalle_productos_orden_compra.numero_orden_compra,
				detalle_productos_orden_compra.id_producto,
				productos.id_familia
				from detalle_productos_orden_compra
				inner join  productos on detalle_productos_orden_compra.id_producto=productos.id_producto
				WHERE detalle_productos_orden_compra.id_pedido_orden_compra=".$id_pedido;
			$resultado=mysql_query($sql2,$conexion->link);
			while ($mensaje=mysql_fetch_array($resultado))
			{	 					
				$cantidad_falt=$mensaje[1]-$mensaje[0];
				$sql3="UPDATE detalle_productos_orden_compra	 
					set 		 
					cantidad_faltante='".$cantidad_falt."'
					where id_pedido_orden_compra=".$id_pedido;
				$resultado3=mysql_query($sql3,$conexion->link);
						
				$sql8="INSERT INTO temporal (id_producto,cantidad,numero_documento,fecha_movimiento,id_tipo_documento,numero_orden_compra,observacion)
						VALUES
					('$mensaje[3]','$cantidad','$numero_documento','$fecha','$id_tipo_documento','$numero_orden_compra','$observacion')";
				$resultado8=mysql_query($sql8,$conexion->link);
			
				 $sql12="select posicion,id
					from veredas
				WHERE id=".$id_posicion;
				$resultado12=mysql_query($sql12,$conexion->link);
				while ($mensaje12= mysql_fetch_array($resultado12))
				{
				 	$sql13="UPDATE veredas	 
						set 		 
						id_estado_vereda=2
						where id=".$mensaje12[1];
					$resultado13=mysql_query($sql13,$conexion->link);
					//$valor_cod_barra=$fila[1].$fila[2].$fila[3].$fila[4];
					$cantidad_por_pallet=$cantidad/$cantidad_pallet; 
					//if ($cantidad_por_pallet >= 1000)
					$sql14="INSERT INTO detalle_veredas (id_vereda,kilos,id_producto)
					VALUES ('$mensaje[1]','$cantidad_por_pallet','$mensaje[3]')";
					$resultado14=mysql_query($sql14,$conexion->link);
												
		

					$sql14="INSERT INTO codigos_barras (posicion,id)
						VALUES ('$mensaje12[0]','$mensaje12[1]')";
					$resultado14=mysql_query($sql14,$conexion->link);
				}	
			}
		}
	}
		catch (Exception $e)
	{    
		 echo $e->getMessage();
	}					
?>