<?php	
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$funcion=trim($_POST["funcion"]);
	if ($funcion==1)
	{
		$sql1="select 
				id_egreso,
				fecha,
				usuarios.usuario,
				pedido_interno
				from egresos
				inner join  usuarios on usuarios.id_Usuario=egresos.id_usuario
				where ingresado='Si' and aceptado_gerencia='' and rechazado_gerencia=''";
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
								Solicitante
							<th>
								Productos
							</th>";
					$ejecuta2=mysql_query($sql1,$conexion->link);
					$fila2=mysql_fetch_array($ejecuta2);
					if ($fila2[3]=='Si')
					{
			 	 		echo "<th>
								Uso Interno
							</th>
							<th>
								Observacion
							</th>";
					}
					echo "</tr> 
					</thead>";
									
										
			while ($fila=mysql_fetch_array($ejecuta))
			{
				$fila[1] = date("d-m-Y", strtotime($fila[1]));
				echo "<tbody >
						<tr>
							<td>".$fila[1]."</td>
							<td>".$fila[2]."</td> 
							<td class='width10' ><a href='#' onClick='$(this).egreso_detalles(".$fila[0].");' title='Ver Informacion' class='icon-ver	info-tooltip'></a></td>";
				if ($fila[3]=='Si')
				{
						echo "<td>".$fila[3]."</td>";
						echo "<td class='width10' ><a href='#' onClick='$(this).observacion_egreso(".$fila[0].");' title='Ver Informacion' class='icon-ver info-tooltip'></a></td>";
				}
				 
						
				echo "</tr>
					</tbody>";
			}
		}
		else
		{
			echo "<td>No Existe Productos Por Aprobar Salida</td>"; 
		}
	}
	else if ($funcion==2)
	{
		$id_egreso=trim($_POST["id_egreso"]);
		$sql1="select 
		detalle_productos_egreso.id_producto,
		productos.nombre_producto,
		detalle_productos_egreso.cantidad,
		egresos.observacion
		from detalle_productos_egreso
		inner join  productos on productos.id_producto=detalle_productos_egreso.id_producto
		inner join  egresos on egresos.id_egreso=detalle_productos_egreso.id_egreso
		where detalle_productos_egreso.id_egreso=".$id_egreso;
		$ejecuta=mysql_query($sql1,$conexion->link);

		while ($fila=mysql_fetch_array($ejecuta))
		{
			echo "<tr>
					<td id='".$fila[0]."' >".utf8_encode($fila[1])."</td>
					<td>".$fila[2]."</td>
				</tr>";
		}
	}
	else if ($funcion==3)
	{
		$sql1="select 
				id_egreso,
				fecha,
				usuarios.usuario
				from egresos
				inner join  usuarios on usuarios.id_Usuario=egresos.id_usuario
				where ingresado='Si' and aceptado_gerencia='Si' and  sacado_stock=''";
		$ejecuta=mysql_query($sql1,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas<>0)
		{
			while ($fila=mysql_fetch_array($ejecuta))
			{
				$fila[1] = date("d-m-Y", strtotime($fila[1]));
				echo "<tr>
						<td id='".$fila[0]."' >".$fila[0]."</td>
						<td>".$fila[1]."</td>
						<td>".$fila[2]."</td> 
						<td class='width10' ><a href='#' onClick='$(this).egreso_detalles_aprobado(".$fila[0].");' title='Ver Informacion' class='icon-ver info-tooltip'></a></td>
					</tr>
					";
			}
		}
		else
		{
			echo "<td>No Existe Productos Por Aprobar Salida</td>"; 
		}
	}
	else if ($funcion==4)
	{
		$id_egreso=trim($_POST["id_egreso"]);
		$sql1="select 
		detalle_productos_egreso.id_producto,
		productos.nombre_producto,
		detalle_productos_egreso.cantidad,
		detalle_productos_egreso.id_detalle_egreso
		from detalle_productos_egreso
		inner join  productos on productos.id_producto=detalle_productos_egreso.id_producto
		where detalle_productos_egreso.id_egreso=".$id_egreso;
		$ejecuta=mysql_query($sql1,$conexion->link);
		while ($fila=mysql_fetch_array($ejecuta))
		{
			echo "<tr>
					<td id='".$fila[0]."'>".utf8_encode($fila[1])."</td>
					<td id='".$fila[0]."'><input type='text' id='cantidad_ingreso' class=".$fila[3]." onchange='$(this).cantidad_ingresa();'  onkeypress='ValidaSoloNumeros()' placeholder='Cantidad Ingresar'/></td>	
					
					<td>".$fila[2]."</td>			
					
				</tr>";
		}
	}
	else if ($funcion==5)
	{
	 	$id_egreso=trim($_POST["id_egreso"]);
		$sql1="select 
		observacion
		from egresos
		where id_egreso=".$id_egreso;
		$ejecuta=mysql_query($sql1,$conexion->link);
		$fila=mysql_fetch_array($ejecuta);		
		echo $fila [0];
	}
	else if ($funcion==6)
	{
	 	$numero_proforma=trim($_POST["numero_proforma"]);
		$sql1="select 
		total
		from proforma
		where numero_proforma=".$numero_proforma;
		$ejecuta=mysql_query($sql1,$conexion->link);
		$fila=mysql_fetch_array($ejecuta);
		if ($fila=="")
		{
			echo "1";
		}
		else
		{
			echo $fila [0];
		}
	}	
	else if ($funcion==7)
	{
	 	$numero_proforma=trim($_POST["numero_proforma"]);
		$sql1="select 
		cliente_internacional.nombre_cliente
		from proforma
		inner join cliente_internacional on cliente_internacional.id_cliente=proforma.id_cliente
		where proforma.numero_proforma=".$numero_proforma;
		$ejecuta=mysql_query($sql1,$conexion->link);
		$fila=mysql_fetch_array($ejecuta);
		echo $fila[0];
	}	
?>