<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select 
			DATE_FORMAT(fecha_orden_compra, '%d/%m/%y') as fecha,
			orden_compra.numero_orden_compra,
			calidad.id_bodega,
			productos.nombre_producto,
			umed.umed,
			calidad.cantidad
			from calidad
			inner join orden_compra on orden_compra.numero_orden_compra=calidad.numero_orden_compra
			inner join productos on productos.id_producto=calidad.id_producto
			inner join umed on umed.id_umed=productos.id_umed
			where  orden_compra.id_area in (6,7) and calidad.aceptada = 'si' and calidad.ingresada = '' and calidad.rechazada = '' and calidad.imprimido = ''";
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
 			$número_filas = mysql_num_rows($ejecuta);
			if ($número_filas<>0)
			{
				while ($fila=mysql_fetch_array($ejecuta))
				{
					echo "<tr>";
					echo "<td id='".$fila[2]."' class='width10'>".$fila[0]."</td>";
					echo "<td class='width15'>".$fila[1]."</td>"; 
					echo "<td class='width10'>".$fila[5]."  ".$fila[4]."</td>"; 
					echo "<td>".$fila[3]."</td>"; 
					echo"<td class='width10'><a href='#' onClick='$(this).ingreso_cantidad_pallet(".$fila[2].");' title='Ver Informacion' class='icon-ver info-tooltip'></a></td>";
					echo "</tr>";
				  
				}
			}
			else 
			{
					echo "No Exiten Productos Para Ingresar";
			}
?>