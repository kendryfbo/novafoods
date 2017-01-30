<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select 
			DATE_FORMAT(fecha_orden_compra, '%d/%m/%y') as fecha,
			orden_compra.numero_orden_compra,
			calidad.id_bodega,
			id_proveedor
			from calidad
			inner join orden_compra on orden_compra.numero_orden_compra=calidad.numero_orden_compra
			where  orden_compra.id_area=3  and calidad.ingresada <> 'si' and calidad.rechazada <> 'si'
			group by orden_compra.numero_orden_compra";
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
 			$número_filas = mysql_num_rows($ejecuta);
			if ($número_filas<>0)
			{
				while ($fila=mysql_fetch_array($ejecuta))
				{
					echo "<tr>";
					echo "<td id='".$fila[2]."' >".$fila[0]."</td>";
					echo "<td>".$fila[1]."</td>"; 
					$sql2="select 
					id_tipo_proveedor
					from orden_compra
					where  numero_orden_compra=".$fila[1];
					$ejecuta2=mysql_query($sql2,$conexion->link);
					if ($fila2=mysql_fetch_array($ejecuta2))
					{
						if ($fila2[0]==1)
						{
							$sql3="select 
							nombre_proveedor
							from proveedores_nacionales
							where  id_proveedor=".$fila[3];
							$ejecuta3=mysql_query($sql3,$conexion->link);
							if ($fila3=mysql_fetch_array($ejecuta3))
							{
									echo "<td>".$fila3[0]."</td>"; 
							}
						}
						else
						{
							$sql3="select 
							nombre_proveedor
							from proveedores_internacionales
							where  id_proveedor=".$fila[3];
							$ejecuta3=mysql_query($sql3,$conexion->link);
							if ($fila3=mysql_fetch_array($ejecuta3))
							{
									echo "<td>".$fila3[0]."</td>"; 
							}

						}
					}
					echo"<td class='width10'><a href='#' onClick='$(this).detalle_orden_productos_pop(".$fila[1].",".$fila[2].");' title='Ver Informacion' class='icon-ver info-tooltip'></a></td>";
					echo "</tr>";
				  
				}
			}
			else 
			{
					echo "No Exiten Productos Por Aprobar";
			}
?>