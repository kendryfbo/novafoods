<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select 
			DATE_FORMAT(orden_compra.fecha_orden_compra, '%d/%m/%y') as fecha,
			orden_compra.numero_orden_compra,
			orden_compra.id_proveedor,
			id_tipo_proveedor
			from detalle_productos_orden_compra
			inner join orden_compra on orden_compra.numero_orden_compra=detalle_productos_orden_compra.numero_orden_compra
			where  orden_compra.id_area=2 and id_estado_orden_compra=5
			group by orden_compra.numero_orden_compra";
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
 			$número_filas = mysql_num_rows($ejecuta);
			if ($número_filas<>0)
			{
				while ($fila=mysql_fetch_array($ejecuta))
				{
					echo "<tr>";
					echo "<td>".$fila[0]."</td>";
					echo "<td>".$fila[1]."</td>"; 
				 	if ($fila[3]==1)
					{
						$sql3="select 
						nombre_proveedor
						from proveedores_nacionales
						where  id_proveedor=".$fila[2];
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
						where  id_proveedor=".$fila[2];
						$ejecuta3=mysql_query($sql3,$conexion->link);
						if ($fila3=mysql_fetch_array($ejecuta3))
						{
							echo "<td>".$fila3[0]."</td>"; 
						}
					}
					echo"<td class='width10'><a href='#' onClick='$(this).detalle_orden_productos_oficina(".$fila[1].");' title='Ver Informacion' class='icon-ver info-tooltip'></a></td>";
					echo "</tr>";
				  
				}
			}
			else 
			{
					echo "No Exiten Productos Por Aprobar";
			}
?>