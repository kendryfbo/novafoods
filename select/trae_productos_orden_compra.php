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
				umed.umed
				from detalle_productos_orden_compra
				inner join productos on productos.id_producto=detalle_productos_orden_compra.id_producto	
				inner join orden_compra on orden_compra.numero_orden_compra=detalle_productos_orden_compra.numero_orden_compra	
				inner join umed on productos.id_umed=umed.id_umed	
				WHERE detalle_productos_orden_compra.numero_orden_compra =".$numero_orden. " and detalle_productos_orden_compra.id_estado_producto in (13,14,16)";				
				$resultado2=mysql_query($sql2,$conexion->link); 
				if ($mensaje3=mysql_fetch_array($resultado2))
				{
					echo "<thead><tr>";
					echo "<th>Cantidad</th>";
					echo "<th>Codigo de Producto</th>";
					echo "<th>Producto</th>";
					/*if ($mensaje3[6]==6 or $mensaje3[6]==7)
					{
						echo "<th></th>";
					}
					else
					{*/
						echo "<th>Cantidad Ingresando</th>";
					/*}
					if ($mensaje3[6]==6 or $mensaje3[6]==7)
					{
						echo "<th>Cantidad de Pallet</th>";
					}*/
					echo "<th>Accion</th>";
					echo "</thead></tr>";
				}
		$resultado=mysql_query($sql2,$conexion->link); 
 		while ($mensaje2=mysql_fetch_array($resultado))
		{	 
			
			/*if ($mensaje2[6]==6 or $mensaje2[6]==7)
			{
				
				echo "<tbody>";			
				echo	"<tr id='productos'>";
				echo	"<td>".$mensaje2[2]."</td>";
				echo	"<td>".$mensaje2[5]."</td>";
				echo	"<td>".utf8_encode($mensaje2[1])."</td>";
				echo	"<td><input type='text' id='cantidad".$mensaje2[0]."'>";
				echo	"<div id='valida-cantidad_mayor".$mensaje2[0]."' style='display:none' class='errores'>Debe Ingresar Menor que la Pedida</div>";
				echo	"<div id='valida-cantidad_numerica".$mensaje2[0]."' style='display:none' class='errores'>Debe Ingresar Valor Numerico</div></td>";
				echo	"<td><input type='text' id='cantidad_pallet".$mensaje2[0]."'>";
				echo	"<div id='valida-cantidad_numerica_pallet".$mensaje2[0]."' style='display:none' class='errores'>Debe Ingresar Valor Numerico</div></td>";
				echo   "<td><input type='button' value='Ingresar Producto&raquo;' onClick='$(this).Ingreso_productos_bodega(".$mensaje2[0].",".$numero_orden.");' id='ingreso".$mensaje2[0]."'/></td></tr>";
				echo "</tbody>";	
			}
			else
			{*/
 
				echo "</tbody>";	
				echo	"<tr id='productos'>";
				echo	"<td>".$mensaje2[2]." ".$mensaje2[6]."</td>";
				echo	"<td>".$mensaje2[5]."</td>";
				echo	"<td>".utf8_encode($mensaje2[1])."</td>";
				/*if ($mensaje3[6]==6 or $mensaje3[6]==7)
				{
						echo	"<td></td>";
				}
				else
				{*/
					echo	"<td><input type='text' id='cantidad".$mensaje2[0]."'>";
					echo	"<div id='valida-cantidad_mayor".$mensaje2[0]."' style='display:none' class='errores'>Debe Ingresar Menor que la Pedida</div>";
					echo	"<div id='valida-cantidad_numerica".$mensaje2[0]."' style='display:none' class='errores'>Debe Ingresar Valor Numerico</div></td>";
				/*}*/
				/*if ($mensaje3[6]==6 or $mensaje3[6]==7)
				{					
					echo	"<input type='hidden' id='cantidad".$mensaje2[0]."' value='".$mensaje2[2]."'>";
					echo   "<td><input type='button' value='Enviar a Calidad&raquo;' id='btn_ingreso".$mensaje2[0]."' onClick='$(this).Ingreso_calidad(".$mensaje2[0].",".$numero_orden.");'/></td></tr>";
				}
				else
				{*/
					echo   "<td><input type='button' value='Ingresar Producto&raquo;' id='btn_ingreso".$mensaje2[0]."' onClick='$(this).Ingreso_productos_bodega_sin_posicion(".$mensaje2[0].",".$numero_orden.");'/></td></tr>";
				/*}*/
			/*}*/
		}	
			echo		"<tr><td><input type='checkbox' id='obsevacion' onClick='$(this).Ingreso_observacion();'>Observacion</td>";
			echo		"<td><textarea rows='4' id='observacion_text'  style='display:none'   placeholder='Ingrese Observacion' cols='30'></textarea></td>";
			echo		"<td></td>";
			echo		"<td></td>";
			echo		"<td><input type='button' value='Aceptar Ingreso&raquo;' id='td_btn_aceptar_productos".$mensaje2[0]."' disabled				onClick='$(this).aceptar_ingreso_bodega_sin_posicion();'/></td>";
			echo	"<td></td>";
			
			echo	"</tr>";
			echo "</tbody>";
 	}
	catch (Exception $e)
	{    
	 echo $e->getMessage();
	}


					
?>	