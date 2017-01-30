<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select 
			DATE_FORMAT(fecha_orden_compra, '%d/%m/%y') as fecha,
			estados_orden_de_compra.estado_orden_compra,
			orden_compra.numero_orden_compra
			from orden_compra
			inner join estados_orden_de_compra on estados_orden_de_compra.id_estado_orden_compra=orden_compra.id_estado_orden_compra
			where orden_compra.id_estado_orden_compra=2";
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
 			$número_filas = mysql_num_rows($ejecuta);
			if ($número_filas<>0)
			{
				while ($fila=mysql_fetch_array($ejecuta))
				{
					echo "<tr>";
					echo "<td id='".$fila[2]."' >".$fila[0]."</td>";
					echo "<td>".$fila[1]."</td>"; 
					echo"<td class='width10' ><a href='#' onClick='$(this).detalle_orden_compra_imprimir();' title='Ver Informacion' class='icon-ver info-tooltip'></a></td>";
					echo "</tr>";
				  
				}
			}
			else 
			{
					echo "No Exiten Ordenes de Compra Por Aprobar";
			}
?>