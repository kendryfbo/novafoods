<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$numero_orden=trim($_POST["numero_orden"]); 
   try{	
		
		$sql2="select
				detalle_productos_orden_compra.id_pedido_orden_compra,
				productos.nombre_producto,
				detalle_productos_orden_compra.cantidad_faltante,
				detalle_productos_orden_compra.total,
				productos.id_producto,
				Productos.codigo_producto,
				orden_compra.id_area
				from detalle_productos_orden_compra
				inner join productos on productos.id_producto=detalle_productos_orden_compra.id_producto	
				inner join orden_compra on orden_compra.numero_orden_compra=detalle_productos_orden_compra.numero_orden_compra	
				WHERE detalle_productos_orden_compra.numero_orden_compra =".$numero_orden. " and orden_compra.id_area=2 ";				
				$resultado2=mysql_query($sql2,$conexion->link); 

					echo "<thead><tr>";
					echo "<th>Cantidad</th>";
					echo "<th>Codigo de Producto</th>";
					echo "<th>Producto</th>";
					/*echo "<th  id='th_titulo' style='display:none' >Cantidad Ingresando</th>";
		 			echo "<th>Accion</th>";*/
					echo "</thead></tr>";
	
		$resultado=mysql_query($sql2,$conexion->link); 
 		while ($mensaje2=mysql_fetch_array($resultado))
		{	 
			echo "<tbody>";			
			echo	"<tr id='productos'>";
			echo	"<td>".$mensaje2[2]."</td>";
			echo	"<td>".$mensaje2[5]."</td>";
			echo	"<td>".utf8_encode($mensaje2[1])."</td>";
		/*	echo	"<td width='35%' id='td_check".$mensaje2[0]."' ><input type='checkbox' onClick='$(this).mostrar_cantidades(".$mensaje2[0].");'>Cambiar</td>";
			echo	"<td id='td_input".$mensaje2[0]."' style='display:none' ><input type='text' placeholder='Ingrese Cantidad Ingresando'  id='cantidad".$mensaje2[0]."'>";
			echo	"<div id='valida-cantidad_mayor".$mensaje2[0]."' style='display:none' class='errores'>Debe Ingresar Menor que la Pedida</div>";
			echo	"<div id='valida-cantidad_numerica".$mensaje2[0]."' style='display:none' class='errores'>Debe Ingresar Valor Numerico</div></td>";
			echo   "<td  id='td_boton".$mensaje2[0]."' style='display:none'><input type='button' id='boton".$mensaje2[0]."' value='Cambiar Cantidad&raquo;' onClick='$(this).Ingreso_productos_bodega_oficina(".$mensaje2[0].",".$numero_orden.",".$mensaje2[2].");'/></td></tr>";*/
		
		}	
			/*echo		"<tr><td><input type='checkbox' id='obsevacion' onClick='$(this).Ingreso_observacion();'>Observacion</td>";
			echo		"<td><textarea rows='4' id='observacion_text' style='display:none' placeholder='Ingrese Observacion' cols='30'></textarea></td>";
			echo		"<td></td>";
			
			echo	"<td></td>";*/

			
			echo	"</tr>";
			echo	"</tbody>";
		}
	catch (Exception $e)
	{    
	 echo $e->getMessage();
	}


					
?>	