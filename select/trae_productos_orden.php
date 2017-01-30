<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);

	if ($funcion==1)
	{
		$numero_orden=trim($_POST["numero_orden"]);	 
	   try{	
			$sql2="select
					detalle_productos_orden_compra.id_pedido_orden_compra,
					productos.nombre_producto,
					detalle_productos_orden_compra.cantidad,
					detalle_productos_orden_compra.total
					from detalle_productos_orden_compra
					inner join productos on productos.id_producto=detalle_productos_orden_compra.id_producto	
					WHERE detalle_productos_orden_compra.numero_orden_compra =".$numero_orden;
					
			$resultado2=mysql_query($sql2,$conexion->link);
			while ($mensaje2=mysql_fetch_array($resultado2))
			{	 					
					echo	"<tr id=".$mensaje2[0].">";
					echo	"<td>".utf8_encode($mensaje2[1])."</td>";
					echo	"<td>".$mensaje2[2]."</td>";
					echo	"<td>".$mensaje2[3]."</td>";
					echo	"</tr>";
			}			 
		}
		catch (Exception $e)
		{    
		 echo $e->getMessage();
		}
	}
	else if ($funcion==2)
	{
		$numero_orden=trim($_POST["numero_orden"]);	 
	   try{	
			$sql2="select
					detalle_productos_orden_compra.id_pedido_orden_compra,
					productos.nombre_producto,
					detalle_productos_orden_compra.cantidad,
					detalle_productos_orden_compra.total,
					productos.codigo_producto,
					detalle_productos_orden_compra.valor_unitario,
					detalle_productos_orden_compra.id_estado_producto
					from detalle_productos_orden_compra
					inner join productos on productos.id_producto=detalle_productos_orden_compra.id_producto	
					WHERE detalle_productos_orden_compra.numero_orden_compra =".$numero_orden;
					
			$resultado2=mysql_query($sql2,$conexion->link);
			while ($mensaje2=mysql_fetch_array($resultado2))
			{	 					
				echo "<tr id=".$mensaje2[0].">
						<td>".$mensaje2[4]."</td>
						<td>".utf8_encode($mensaje2[1])."</td>
						<td>".$mensaje2[2]."</td>
						<td>".$mensaje2[5]."</td>
						<td>".$mensaje2[3]."</td>";
						if ($mensaje2[6]<>9)
						{
							echo "<td></td>";

						}
						else
						{						
							echo "<td><a href='#' onClick='$(this).elimina_aduana();' title='Borrar Informacion' class='icon-borrar info-user'></a></td>";
						}
					echo "</tr>";
			}
			 
		}
		catch (Exception $e)
		{    
		 echo $e->getMessage();
		}
	}


					
?>	