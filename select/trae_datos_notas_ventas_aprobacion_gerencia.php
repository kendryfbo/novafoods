<?php	
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$funcion=trim($_POST["funcion"]);
	if ($funcion==1)
	{
		$sql1="select 
				Numero_nota_venta,
				cliente_nacional.rut,
				cliente_nacional.nombre_cliente,
				condiciones_pago.Condicion,
				nota_venta.total
				from nota_venta
				inner join  cliente_nacional on cliente_nacional.id_cliente=nota_venta.id_cliente
				inner join  condiciones_pago on condiciones_pago.id_condicion=nota_venta.id_condicion
				where ingresada='Si' and aceptada='' and rechazada='' ";
		$ejecuta=mysql_query($sql1,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas<>0)
		{
			echo "<thead> 
						<tr>
							<th>
								N.vta
							</th>					 
							<th>
								Rut
							<th>
								Cliente
							</th>
							<th>
								Monto
							</th>
							<th>
								Condicion Vta
							</th>
							<th>
								Aceptar
							</th>
							<th>
								Rechazar
							</th>
							<th>
								Detalle
							</th>	
						</tr> 
					</thead>";
			while ($fila=mysql_fetch_array($ejecuta))
			{
				
				echo "<tbody >
						<tr>
							<td>".$fila[0]."</td>
							<td>".$fila[1]."</td> 
							<td>".$fila[2]."</td> 
							<td>".number_format($fila[4] ,2	 , "," ,".")."</td> 				 
							<td>".$fila[3]."</td> 
							<td class='width10'><a href='#' onClick='$(this).aceptar_nota_venta(".$fila[0].");' title='Aceptar' class='icon-editar info-tooltip'></a></td>
							<td class='width10'><a href='#' onClick='$(this).rechazar_nota_venta(".$fila[0].");' title='Rechazar' class='icon-editar info-tooltip'></a></td>
							<td class='width10'><a href='#' onClick='$(this).detalles_nota_venta(".$fila[0].");' title='Detalles' class='icon-ver info-tooltip'></a></td>
						</tr>
					</tbody>";
			}
		}
		else
		{
			echo "<td>No Existen Notas de Venta Por Aprobar</td>"; 
		}
	}
	else if ($funcion==2)
	{
		$Numero_nota_venta=trim($_POST["Numero_nota_venta"]);
		try{
			$sql1="UPDATE nota_venta	 
				set 		 
				aceptada='Si'
				where Numero_nota_venta=".$Numero_nota_venta;
			$resultado2=mysql_query($sql1,$conexion->link);
			echo "Nota de Venta Aceptada";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


	}
	else if ($funcion==3)
	{
		$Numero_nota_venta=trim($_POST["Numero_nota_venta"]);
		try{
			$sql1="UPDATE nota_venta	 
				set 		 
				rechazada='Si'
				where Numero_nota_venta=".$Numero_nota_venta;
			$resultado2=mysql_query($sql1,$conexion->link);
		
			$sql2="DELETE FROM bodega_producto_terminado	
			WHERE Numero_nota_venta=".$Numero_nota_venta;

			$resultado1=mysql_query($sql2,$conexion->link);
			echo "Nota de Venta Rechazada";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
	}
	else if ($funcion==4)
	{
		$Numero_nota_venta=trim($_POST["Numero_nota_venta"]);
		$sql1="select 
				productos.nombre_producto,
				detalle_nota_venta.Cantidad,
				detalle_nota_venta.total
				from detalle_nota_venta
				inner join  productos on productos.id_producto=detalle_nota_venta.id_producto
				where numero_nota_venta=".$Numero_nota_venta;
		$ejecuta=mysql_query($sql1,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas<>0)
		{
			echo "	<tr>
							<th>
								Prducto
							</th>					 
							<th>
								&nbsp;   Cantidad
							<th>
								&nbsp;   Total
							</th>				
						</tr> 
					";
			while ($fila=mysql_fetch_array($ejecuta))
			{
				echo "	<tr>
							<td><br>".utf8_encode($fila[0])."</td>
							<td><br>&nbsp;&nbsp;&nbsp;&nbsp;".$fila[1]."</td> 
							<td><br>&nbsp;".number_format($fila[2] ,2, "," ,".")."</td> 				 
						</tr>";
			}
		}
		else
		{
			echo "No ahi Productos";	
		}
	}
?>