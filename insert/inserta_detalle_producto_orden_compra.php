<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);

	if ($funcion==1)
	{

		$id_producto=trim($_POST["id_producto"]);
		$cantidad=trim($_POST["cantidad"]);
		$precio=trim($_POST["precio"]);
		$numero_orden_compra=trim($_POST["numero_orden_compra"]);
		try{	
				$total=$cantidad*$precio;
					
				$sql3="INSERT INTO detalle_productos_orden_compra (cantidad,total,id_producto,numero_orden_compra,valor_unitario,cantidad_faltante,id_estado_producto)
				VALUES ('$cantidad','$total','$id_producto','$numero_orden_compra','$precio','$cantidad',9)";

				$resultado=mysql_query($sql3,$conexion->link);
									
				$id_pedido_orden_compra=mysql_insert_id();

	
				$sql2="select
						detalle_productos_orden_compra.id_pedido_orden_compra,
						productos.nombre_producto,
						detalle_productos_orden_compra.cantidad,
						detalle_productos_orden_compra.total,
						detalle_productos_orden_compra.valor_unitario,
						productos.codigo_producto
						from detalle_productos_orden_compra
						inner join productos on productos.id_producto=detalle_productos_orden_compra.id_producto	
						WHERE detalle_productos_orden_compra.id_pedido_orden_compra =".$id_pedido_orden_compra;
						
				$resultado2=mysql_query($sql2,$conexion->link);
				$mensaje2=mysql_fetch_array($resultado2);
											
						echo	"<tr id=".$mensaje2[0].">";
						echo	"<td>".$mensaje2[5]."</td>";
						echo	"<td>".utf8_encode($mensaje2[1])."</td>";
						echo	"<td>".$mensaje2[2]."</td>";
						echo	"<td>".$mensaje2[4]."</td>";
						echo	"<td>".$mensaje2[3]."</td>";
						echo	"<td><a href='#' title='Borrar Informacion' onClick='$(this).elimina_prod_detalle_modificar(".$mensaje2[0].",".$numero_orden_compra.");'class='icon-borrar info-tooltip'></a></td>";
						echo "</tr>";		 	 
				 
			}
			catch (Exception $e)
			{    
			 echo $e->getMessage();
			}
	}
	else if ($funcion==2)
	{
		$id_producto=trim($_POST["id_producto"]);
		$cantidad=trim($_POST["cantidad"]);
		$precio=trim($_POST["precio"]);
		$numero_orden_compra=trim($_POST["numero_orden_compra"]);
		$id_usuario=trim($_POST["id_usuario"]);
		
		try{	
				$total=$cantidad*$precio;
				$sql="select					
					temporal_orden_compra.id_temporal_orden_compra		
					from temporal_orden_compra
					WHERE temporal_orden_compra.id_temporal_orden_compra=".$numero_orden_compra;					
				$resultado=mysql_query($sql,$conexion->link);
				$mensaje=mysql_fetch_array($resultado);

				if ($mensaje[0]=="")
				{
					$sql6="INSERT INTO temporal_orden_compra (id_usuario)
						VALUES ('$id_usuario')";
					$resultado6=mysql_query($sql6,$conexion->link);
					$numero_orden_compra=mysql_insert_id();
				}
				else
				{
					$valor=$numero_orden_compra;
				}			
					
				$sql3="INSERT INTO temporal_detalle_productos_orden_compra (cantidad,total,id_producto,numero_orden_compra,valor_unitario,cantidad_faltante,id_estado_producto)
				VALUES ('$cantidad','$total','$id_producto','$numero_orden_compra','$precio','$cantidad',9)";
				$resultado=mysql_query($sql3,$conexion->link);									
				$id_pedido_orden_compra=mysql_insert_id();

	
				$sql2="select
						temporal_detalle_productos_orden_compra.temporal_id_pedido_orden_compra,
						productos.nombre_producto,
						temporal_detalle_productos_orden_compra.cantidad,
						temporal_detalle_productos_orden_compra.total,
						temporal_detalle_productos_orden_compra.valor_unitario,
						productos.codigo_producto
						from temporal_detalle_productos_orden_compra
						inner join productos on productos.id_producto=temporal_detalle_productos_orden_compra.id_producto	
						WHERE temporal_detalle_productos_orden_compra.temporal_id_pedido_orden_compra =".$id_pedido_orden_compra;
						
				$resultado2=mysql_query($sql2,$conexion->link);
				$mensaje2=mysql_fetch_array($resultado2);
											
						echo	"<tr id=".$mensaje2[0].">";
						echo	"<td>".$mensaje2[5]."</td>";
						echo	"<td>".utf8_encode($mensaje2[1])."</td>";
						echo	"<td>".$mensaje2[2]."</td>";
						echo	"<td>".$mensaje2[4]."</td>";
						echo	"<td>".$mensaje2[3]."</td>";
						echo	"<td><a href='#' title='Borrar Informacion' onClick='$(this).elimina_prod_detalle(".$mensaje2[0].",".$numero_orden_compra.");'class='icon-borrar info-tooltip'></a></td>";
						echo	"<input type='hidden' id='numero_orden_compra' value=".$numero_orden_compra." >" ;
						echo "</tr>";		 	 
				 
			}
			catch (Exception $e)
			{    
			 echo $e->getMessage();
			}
	}


					
?>	