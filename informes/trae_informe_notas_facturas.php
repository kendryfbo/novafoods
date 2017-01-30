<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_tipo_cliente=trim($_POST["id_tipo_cliente"]);

	switch ($id_tipo_cliente)
	{
		case 1:
				$cliente_nacional=trim($_POST["cliente_nacional"]);
				if ($cliente_nacional==298)
				{
					$fecha_inicio=trim($_POST["fecha_inicio"]);
					$fecha_fin=trim($_POST["fecha_fin"]);				
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
						$sql1="select cliente_nacional.nombre_cliente,
						facturas.total,
						DATE_FORMAT(facturas.fecha_factura, '%d/%m/%Y'),
						numero_factura
						from facturas
						inner join cliente_nacional on cliente_nacional.id_cliente=facturas.id_cliente
						where (facturas.fecha_factura BETWEEN '".$fecha_inicio_2."' AND '".$fecha_fin_2."')";
						$ejecuta1=mysql_query($sql1,$conexion->link);?>
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
									<th>Nombre de Cliente</th>
									<th>Total</th>
									<th>Fecha </th>
									<th>Numero de Factura</th>
								</tr>
							</thead>
							<tbody>
								<?php while($fila1=mysql_fetch_array($ejecuta1)){?>
								<tr>
									<td><?php echo $fila1[0]; ?></td>
									<td><?php echo number_format( $fila1[1]); ?></td>
									<td><?php echo $fila1[2]; ?></td>
									<td><?php echo $fila1[3]; ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php }
				}
				else
				{
					$fecha_inicio=trim($_POST["fecha_inicio"]);
					$fecha_fin=trim($_POST["fecha_fin"]);				
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
						$sql1="select cliente_nacional.nombre_cliente,
						facturas.total,
						DATE_FORMAT(facturas.fecha_factura, '%d/%m/%Y'),
						numero_factura
						from facturas
						inner join cliente_nacional on cliente_nacional.id_cliente=facturas.id_cliente
						where facturas.id_cliente=".$cliente_nacional." and
						(facturas.fecha_factura BETWEEN '".$fecha_inicio_2."' AND '".$fecha_fin_2."')";
						$ejecuta1=mysql_query($sql1,$conexion->link);?>
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
									<th>Nombre de Cliente</th>
									<th>Total</th>
									<th>Fecha </th>
									<th>Numero de Factura</th>
								</tr>
							</thead>
							<tbody>
								<?php while($fila1=mysql_fetch_array($ejecuta1)){?>
								<tr>
									<td><?php echo $fila1[0]; ?></td>
									<td><?php echo number_format( $fila1[1]); ?></td>
									<td><?php echo $fila1[2]; ?></td>
									<td><?php echo $fila1[3]; ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php }
				}
			break;
			case 2:
				$cliente_internacional=trim($_POST["cliente_internacional"]);
				if ($cliente_internacional==90)
				{
					$fecha_inicio=trim($_POST["fecha_inicio"]);
					$fecha_fin=trim($_POST["fecha_fin"]);				
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
						$sql1="select cliente_internacional.nombre_cliente,
						factura_internacional.total,
						DATE_FORMAT(factura_internacional.fecha_factura, '%d/%m/%Y'),
						factura_internacional.numero_factura
						from factura_internacional
						inner join cliente_internacional on cliente_internacional.id_cliente=factura_internacional.id_cliente
						where (factura_internacional.fecha_factura BETWEEN '".$fecha_inicio_2."' AND '".$fecha_fin_2."')";
						$ejecuta1=mysql_query($sql1,$conexion->link);?>
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
									<th>Nombre de Cliente</th>
									<th>Total</th>
									<th>Fecha </th>
									<th>Numero de Factura</th>
								</tr>
							</thead>
							<tbody>
								<?php while($fila1=mysql_fetch_array($ejecuta1)){?>
								<tr>
									<td><?php echo $fila1[0]; ?></td>
									<td><?php echo number_format($fila1[1]); ?></td>
									<td><?php echo $fila1[2]; ?></td>
									<td><?php echo $fila1[3]; ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php }
				}
				else
				{
					$fecha_inicio=trim($_POST["fecha_inicio"]);
					$fecha_fin=trim($_POST["fecha_fin"]);				
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
						$sql1="select cliente_internacional.nombre_cliente,
						factura_internacional.total,
						DATE_FORMAT(factura_internacional.fecha_factura, '%d/%m/%Y'),
						numero_proforma
						from factura_internacional
						inner join cliente_internacional on cliente_internacional.id_cliente=factura_internacional.id_cliente
						where factura_internacional.id_cliente=".$cliente_internacional." and
						(factura_internacional.fecha_factura BETWEEN '".$fecha_inicio_2."' AND '".$fecha_fin_2."')";
						$ejecuta1=mysql_query($sql1,$conexion->link);?>
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
									<th>Nombre de Cliente</th>
									<th>Total</th>
									<th>Fecha </th>
									<th>Numero de Factura</th>
								</tr>
							</thead>
							<tbody>
								<?php while($fila1=mysql_fetch_array($ejecuta1)){?>
								<tr>
									<td><?php echo $fila1[0]; ?></td>
									<td><?php echo number_format($fila1[1]); ?></td>
									<td><?php echo $fila1[2]; ?></td>
									<td><?php echo $fila1[3]; ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php }
				}					
			break;
			default:
       
	}

 