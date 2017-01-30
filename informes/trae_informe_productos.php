<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$fecha_inicio=trim($_POST["fecha_inicio"]);
	$fecha_fin=trim($_POST["fecha_fin"]);	
	$id_producto=trim($_POST["id_producto"]);		

	$fecha_inicio_1 = strtotime($fecha_inicio);	
	$fecha_fin_1 = strtotime($fecha_fin);
	if($fecha_fin_1 < $fecha_inicio_1)
	{
		echo "Error";
	}
	else
	{
		$fecha_inicio_2=date("Y-m-d",strtotime($fecha_inicio));
		$fecha_fin_2=date("Y-m-d",strtotime($fecha_fin));
			$sql1="select 
				productos.nombre_producto,
				detalle_factura.cantidad,
				DATE_FORMAT(facturas.fecha_factura, '%d/%m/%Y'),
				detalle_factura.precio,
				detalle_factura.descuento_porcentaje,
				detalle_factura.descuento,
				detalle_factura.total
				from detalle_factura
				inner join productos on productos.id_producto=detalle_factura.id_producto
				inner join facturas on facturas.numero_factura=detalle_factura.factura
				where detalle_factura.id_producto=".$id_producto." and  (facturas.fecha_factura BETWEEN '".$fecha_inicio_2."' AND '".$fecha_fin_2."')
				UNION 
				select 
				productos.nombre_producto,
				detalle_factura_internacional.cantidad,
				DATE_FORMAT(factura_internacional.fecha_factura, '%d/%m/%Y'),
				detalle_factura_internacional.precio,
				0,
				0,
				detalle_factura_internacional.total
				from detalle_factura_internacional
				inner join productos on productos.id_producto=detalle_factura_internacional.id_producto
				inner join factura_internacional on factura_internacional.numero_factura=detalle_factura_internacional.numero_factura
				where detalle_factura_internacional.id_producto=".$id_producto." and  (factura_internacional.fecha_factura BETWEEN '".$fecha_inicio_2."' AND '".$fecha_fin_2."')	";
			$ejecuta1=mysql_query($sql1,$conexion->link);
		?>
		<script>
			$(document).ready(function() {
				$('#dataTable_inc').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				});
			});
		</script>
		<table id='dataTable_inc' cellpadding="0" cellspacing="0" border="0" class="display">
			<thead>
				<tr>
					<th>Nombre de Producto</th>
					<th>Cantidad</th>
					<th>Fecha</th>
					<th>Precio</th>
					<th>% descuento</th>
					<th>Total Descuento</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php while($fila1=mysql_fetch_array($ejecuta1)){?>
					<tr>
						<td><?php echo utf8_encode($fila1[0]); ?></td>
						<td><?php echo number_format( $fila1[1]); ?></td>
						<td><?php echo $fila1[2]; ?></td>
						<td><?php echo number_format($fila1[3]); ?></td>
						<td><?php echo $fila1[4]; ?></td>
						<td><?php echo number_format($fila1[5]); ?></td>
						<td><?php echo number_format($fila1[6]); ?></td>
					</tr>
				<?php } ?>
			</tbody>	
		</table>
<?php }?>