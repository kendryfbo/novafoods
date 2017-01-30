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
						nota_venta.total,
						DATE_FORMAT(nota_venta.fecha_emision, '%d/%m/%Y'),
						Numero_nota_venta
						from nota_venta
						inner join cliente_nacional on cliente_nacional.id_cliente=nota_venta.id_cliente
						where (nota_venta.fecha_emision BETWEEN '".$fecha_inicio_2."' AND '".$fecha_fin_2."')";
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
									<th>Fecha de Emision</th>
									<th>Numero de Nota de Venta</th>
								</tr>
							</thead>
							<tbody>
								<?php while($fila1=mysql_fetch_array($ejecuta1)){?>
								<tr>
									<td><?php echo utf8_encode($fila1[0]); ?></td>
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
							nota_venta.total,
							DATE_FORMAT(nota_venta.fecha_emision, '%d/%m/%Y'),
							Numero_nota_venta
							from nota_venta
							inner join cliente_nacional on cliente_nacional.id_cliente=nota_venta.id_cliente
							where nota_venta.id_cliente=".$cliente_nacional." and
							(nota_venta.fecha_emision BETWEEN '".$fecha_inicio_2."' AND '".$fecha_fin_2."')";
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
										<th>Fecha de Emision</th>
										<th>Numero de Nota de Venta</th>
									</tr>
								</thead>
								<tbody>
									<?php while($fila1=mysql_fetch_array($ejecuta1)){?>
									<tr>
										<td><?php echo utf8_encode($fila1[0]); ?></td>
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
						proforma.total,
						DATE_FORMAT(proforma.fecha_proforma, '%d/%m/%Y'),
						numero_proforma
						from proforma
						inner join cliente_internacional on cliente_internacional.id_cliente=proforma.id_cliente
						where (proforma.fecha_proforma BETWEEN '".$fecha_inicio_2."' AND '".$fecha_fin_2."')";
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
									<th>Fecha de Emision</th>
									<th>Numero de Proforma</th>
								</tr>
							</thead>
							<tbody>
								<?php while($fila1=mysql_fetch_array($ejecuta1)){?>
								<tr>
									<td><?php echo utf8_encode($fila1[0]); ?></td>
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
						proforma.total,
						DATE_FORMAT(proforma.fecha_proforma, '%d/%m/%Y'),
						numero_proforma
						from proforma
						inner join cliente_internacional on cliente_internacional.id_cliente=proforma.id_cliente
						where proforma.id_cliente=".$cliente_internacional." and
						(proforma.fecha_proforma BETWEEN '".$fecha_inicio_2."' AND '".$fecha_fin_2."')";
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
									<th>Fecha de Emision</th>
									<th>Numero de Proforma</th>
								</tr>
							</thead>
							<tbody>
								<?php while($fila1=mysql_fetch_array($ejecuta1)){?>
								<tr>
									<td><?php echo utf8_encode($fila1[0]); ?></td>
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

 
   


					
?>	
