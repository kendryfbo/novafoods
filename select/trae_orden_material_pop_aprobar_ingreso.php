<?php	
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$funcion=trim($_POST["funcion"]);
	if ($funcion==1)
	{
		$sql1="select 
				id_ingreso,
				fecha
				from ingreso_manual_material_pop
				where ingresado='Si' and aceptado='' and ingresado_stock=''";
		$ejecuta=mysql_query($sql1,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas<>0)
		{
			echo "<thead> 
						<tr>
							<th>
								Fecha
							</th>					 										 
							<th>
								Observacion
							</th>
							<th>
								Aceptar
							</th>";					
					echo "</tr> 
					</thead>";									
			while ($fila=mysql_fetch_array($ejecuta))
			{
				$fila[1] = date("d-m-Y", strtotime($fila[1]));
				echo "<tbody >
						<tr>
							<td>".$fila[1]."</td>
								<td class='width10'><a href='#' onClick='$(this).ver_observacion_ingreso(".$fila[0].");' title='Ver Informacion' class='icon-ver	info-tooltip'></a></td>
								<td class='width10'><a href='#' onClick='$(this).aprobacion_ingreso(".$fila[0].");' title='Aceptar Ingreso' class='icon-editar info-tooltip'></a></td>
					</tr>
					</tbody>";
			}
		}
		else
		{
			echo "<td>No Existen Productos Por Aprobar Ingreso</td>"; 
		}
	}
	else if ($funcion==2)
	{
		$id_ingreso=trim($_POST["id_ingreso"]);
		$sql1="select 
				observacion
				from ingreso_manual_material_pop
				where id_ingreso=".$id_ingreso;
		$ejecuta=mysql_query($sql1,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
	 	$fila=mysql_fetch_array($ejecuta);
		if ($fila[0]<>"")
		{
			echo utf8_encode($fila[0]);
		}
		else
		{
			echo "Sin Observacion"; 
		}
	}
	else if ($funcion==3)
	{
		$id_ingreso=trim($_POST["id_ingreso"]);
		try{
			$sql1="UPDATE ingreso_manual_material_pop	 
				set 		 
				aceptado='Si'
				where id_ingreso=".$id_ingreso;

			$resultado2=mysql_query($sql1,$conexion->link);
	
			echo "Ingreso Aprobado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
	}
	else if ($funcion==4)
	{
		$sql1="select 
					id_ingreso,
					fecha
					from ingreso_manual_material_pop
					where ingresado='Si' and aceptado='Si' and ingresado_stock=''";
		$ejecuta=mysql_query($sql1,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas<>0)
		{
			echo "<thead> 
						<tr>
							<th>
								Fecha
							</th>					 										 
							<th>
								Aceptar
							</th>";					
					echo "</tr> 
					</thead>";									
			while ($fila=mysql_fetch_array($ejecuta))
			{
				$fila[1] = date("d-m-Y", strtotime($fila[1]));
				echo "<tbody >
						<tr>
							<td>".$fila[1]."</td>
								<td class='width10'><a href='#' onClick='$(this).ingreso_stock_pop(".$fila[0].");' title='Aceptar Ingreso' class='icon-editar info-tooltip'></a></td>
						</tr>
					</tbody>";
			}
		}
		else
		{
			echo "<td>No Existen Productos Aprobados Por Gerencia</td>"; 
		}
	}
	else if ($funcion==5)
	{
		$id_ingreso=trim($_POST["id_ingreso"]);
		$fecha=date("y-m-d H:i:s");
		$sql1="select 
					id_producto,
					cantidad
					from detalle_ingreso_manual_pop
					where id_ingreso=".$id_ingreso;
		$ejecuta=mysql_query($sql1,$conexion->link);
		while ($fila=mysql_fetch_array($ejecuta))
		{
			try{
				$sql3="INSERT INTO bodega_pop (id_producto,cantidad,numero_documento,fecha_movimiento,observacion)
				VALUES ('$fila[0]','$fila[1]','$id_ingreso','$fecha','Ingreso Manual')";
				$resultado=mysql_query($sql3,$conexion->link);
			}
				catch (Exception $e)
			{    
				echo $e->getMessage();
			}
		}	
		try{
			$sql1="UPDATE ingreso_manual_material_pop	 
				set 		 
				ingresado_stock='Si'
				where id_ingreso=".$id_ingreso;

			$resultado2=mysql_query($sql1,$conexion->link);
	
			echo "Materiales Ingresados en Stock";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
	}

?>