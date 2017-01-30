<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select 
			DATE_FORMAT(fecha_orden_compra, '%d/%m/%y') as fecha,
			orden_compra.numero_orden_compra,
			calidad.id_bodega
			from calidad
			inner join orden_compra on orden_compra.numero_orden_compra=calidad.numero_orden_compra
			where orden_compra.id_area in (6,7) and calidad.aceptada<> 'si' and calidad.rechazada <> 'si'
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
					echo"<td class='width10'><a href='#' onClick='$(this).detalle_orden_productos_mantencion(".$fila[1].",".$fila[2].");' title='Ver Informacion' class='icon-ver info-tooltip'></a></td>";
					echo "</tr>";
				  
				}
			}
			else 
			{
					echo "No Exiten Productos Sin Aprobar";
			}
?>