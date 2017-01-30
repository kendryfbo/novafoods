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
 
try{
		$sql2="select
				cantidad_faltante
				from detalle_productos_orden_compra
				WHERE id_pedido_orden_compra=".$id_pedido;
		$resultado=mysql_query($sql2,$conexion->link);
		if($mensaje1=mysql_fetch_array($resultado))
		{
			if ($cantidad<$mensaje1[0])
			{	
				if ($cantidad>0)
				{
					$sql1="UPDATE detalle_productos_orden_compra	 
							set 		 
							cantidad_ingresa='".$cantidad."'
							where id_pedido_orden_compra=".$id_pedido;
					$resultado1=mysql_query($sql1,$conexion->link);
					$sql2="select
							cantidad_ingresa,
							cantidad_faltante,
							numero_orden_compra,
							id_producto,
							id_pedido_orden_compra
							from detalle_productos_orden_compra
							WHERE id_pedido_orden_compra=".$id_pedido;
					$resultado=mysql_query($sql2,$conexion->link);
					while ($mensaje=mysql_fetch_array($resultado))
					{	 					
						$cantidad_falt=$mensaje[1]-$mensaje[0];
						$sql3="UPDATE detalle_productos_orden_compra	 
							set 		 
							cantidad_faltante='".$cantidad_falt."'
							where id_pedido_orden_compra=".$id_pedido;
						$resultado3=mysql_query($sql3,$conexion->link);
						$sql5="select
							id_sector_producto
							from productos
							WHERE id_producto=".$mensaje[3];
						$resultado5=mysql_query($sql5,$conexion->link);
						while ($mensaje5=mysql_fetch_array($resultado5))
						{
							switch ($mensaje5[0]) {
								case 1:
									try{	
											$sql6="INSERT INTO calidad (id_pedido_orden_compra,id_producto,cantidad,numero_documento,fecha_movimiento,id_tipo_documento,numero_orden_compra,observacion)
												VALUES
											('$mensaje[4]','$mensaje[3]','$cantidad','$numero_documento','$fecha','$id_tipo_documento','$numero_orden_compra','$observacion')";
											$resultado6=mysql_query($sql6,$conexion->link);
										}
											catch (Exception $e)
										{    
											 echo $e->getMessage();
										}
								break;
								case 2:
									try{	
											$sql7="INSERT INTO calidad (id_pedido_orden_compra,id_producto,cantidad,numero_documento,fecha_movimiento,id_tipo_documento,numero_orden_compra,observacion)
												VALUES
											('$mensaje[4]','$mensaje[3]','$cantidad','$numero_documento','$fecha','$id_tipo_documento','$numero_orden_compra','$observacion')";

											$resultado7=mysql_query($sql7,$conexion->link);
										}
											catch (Exception $e)
										{    
											 echo $e->getMessage();
										}
								break;
								case 3:
									try{	
											$sql8="INSERT INTO calidad (id_pedido_orden_compra,id_producto,cantidad,numero_documento,fecha_movimiento,id_tipo_documento,numero_orden_compra,observacion)
												VALUES
											('$mensaje[4]','$mensaje[3]','$cantidad','$numero_documento','$fecha','$id_tipo_documento','$numero_orden_compra','$observacion')";

											$resultado8=mysql_query($sql8,$conexion->link);
										}
											catch (Exception $e)
										{    
											 echo $e->getMessage();
										}
								break;
								default:
								// aqui ingresaria si es materia prima 
									try{	
											$sql8="INSERT INTO calidad (id_pedido_orden_compra,id_producto,cantidad,numero_documento,fecha_movimiento,id_tipo_documento,numero_orden_compra,observacion)
												VALUES
											('$mensaje[4]','$mensaje[3]','$cantidad','$numero_documento','$fecha','$id_tipo_documento','$numero_orden_compra','$observacion')";

											$resultado8=mysql_query($sql8,$conexion->link);
										}
											catch (Exception $e)
										{    
											 echo $e->getMessage();
										}								
							}
						}
					}
				}		
			}
			else
			{
				$sql1="UPDATE detalle_productos_orden_compra	 
					set 		 
					cantidad_faltante=0,
					id_estado_producto=10
					where id_pedido_orden_compra=".$id_pedido;
					$resultado1=mysql_query($sql1,$conexion->link);

				$sql20="select cantidad_faltante from detalle_productos_orden_compra	 
					where numero_orden_compra=".$numero_orden_compra." group by cantidad_faltante";
					$resultado20=mysql_query($sql20,$conexion->link);
					$num_fields = mysql_num_rows($resultado20);
					if ($num_fields==1)
					{
						$sql21="UPDATE orden_compra	 
							set 		 
							id_estado_orden_compra=7							 
							where numero_orden_compra=".$numero_orden_compra;
						$resultado21=mysql_query($sql21,$conexion->link);
					}
				$sql2="select
						cantidad_ingresa,
						cantidad_faltante,
						numero_orden_compra,
						id_producto,
						id_pedido_orden_compra
						from detalle_productos_orden_compra
						WHERE id_pedido_orden_compra=".$id_pedido;
				$resultado=mysql_query($sql2,$conexion->link);
				while ($mensaje=mysql_fetch_array($resultado))
				{	 					
					$sql5="select
						id_sector_producto
						from productos
						WHERE id_producto=".$mensaje[3];
					$resultado5=mysql_query($sql5,$conexion->link);
					while ($mensaje5=mysql_fetch_array($resultado5))
					{
						switch ($mensaje5[0]) {
							case 1:
								try{	
										$sql6="INSERT INTO calidad (id_pedido_orden_compra,id_producto,cantidad,numero_documento,fecha_movimiento,id_tipo_documento,numero_orden_compra,observacion)
											VALUES
										('$mensaje[4]','$mensaje[3]','$cantidad','$numero_documento','$fecha','$id_tipo_documento','$numero_orden_compra','$observacion')";

										$resultado6=mysql_query($sql6,$conexion->link);
									}
										catch (Exception $e)
									{    
										 echo $e->getMessage();
									}
							break;
							case 2:
								try{	
										$sql7="INSERT INTO calidad (id_pedido_orden_compra,id_producto,cantidad,numero_documento,fecha_movimiento,id_tipo_documento,numero_orden_compra,observacion)
											VALUES
										('$mensaje[4]','$mensaje[3]','$cantidad','$numero_documento','$fecha','$id_tipo_documento','$numero_orden_compra','$observacion')";

										$resultado7=mysql_query($sql7,$conexion->link);
									}
										catch (Exception $e)
									{    
										 echo $e->getMessage();
									}
							break;
							case 3:
								try{	
										$sql8="INSERT INTO calidad (id_pedido_orden_compra,id_producto,cantidad,numero_documento,fecha_movimiento,id_tipo_documento,numero_orden_compra,observacion)
											VALUES
									   ('$mensaje[4]','$mensaje[3]','$cantidad','$numero_documento','$fecha','$id_tipo_documento','$numero_orden_compra','$observacion')";

										$resultado8=mysql_query($sql8,$conexion->link);
									}
										catch (Exception $e)
									{    
										 echo $e->getMessage();	
									}
							break;
							default:
								// aqui ingresaria si es materia prima 
									try{	
											$sql8="INSERT INTO calidad (id_pedido_orden_compra,id_producto,cantidad,numero_documento,fecha_movimiento,id_tipo_documento,numero_orden_compra,observacion)
												VALUES
											('$mensaje[4]','$mensaje[3]','$cantidad','$numero_documento','$fecha','$id_tipo_documento','$numero_orden_compra','$observacion')";

											$resultado8=mysql_query($sql8,$conexion->link);
										}
											catch (Exception $e)
										{    
											 echo $e->getMessage();
										}								
						}
					}
				}
			}
		}
	}
		catch (Exception $e)
	{    
		 echo $e->getMessage();
	}


					
?>		