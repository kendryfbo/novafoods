<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=$_POST["funcion"];
	if ($funcion==1)
	{
		$id_cliente=$_POST["id_cliente"];
		$sql1="select 
				total,
				numero_factura,
				DATE_FORMAT(fecha_factura, '%d-%m-%y') as fecha
				from factura_internacional
				where id_cliente=".$id_cliente;
		$ejecuta=mysql_query($sql1,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas<>0)
		{
			echo "<thead> 
						<tr>
							<th>
								Numero de Factura
							</th>					 										 
							<th>
								Fecha
							<th>
								Total
							</th>
							<th>
								Saldo
							</th>
							<th>
								PT
							</th>
							<th>
								Pago
							</th>
						</tr>
					</thead>";
			while ($fila = mysql_fetch_array($ejecuta))
			{
				echo "<tbody >
						<tr>
							<td>".$fila[1]."</td>
							<td>".$fila[2]."</td>
							<td>".$fila[0]."</td>
							<td></td>
							<td></td>
							<td></td>";					
				echo "</tr>
					</tbody>";
			}
		}
		else
		{
			echo "No Tiene Facturas";
		}
	}
	else if ($funcion==2)
	{
		$cliente=$_POST["cliente"];
		$fecha=$_POST["fecha"];
		$monto=$_POST["monto"];
		$n_documento=$_POST["n_documento"];
		$fecha=date("Y-m-d",strtotime($fecha));

		$sql="INSERT INTO pagos_internacionales (id_cliente,fecha_deposito,monto_deposito,numero_factura)
				VALUES ('$cliente','$fecha','$monto','$n_documento')";
 		$resultado=mysql_query($sql,$conexion->link);
	}
	else if ($funcion==3)
	{
		$id_cliente_nacional=$_POST["id_cliente_nacional"];
		$id_banco=$_POST["id_banco"];
		$numero_cheque=$_POST["numero_cheque"];
		$fecha_vencimiento=$_POST["fecha_vencimiento"];
		$monto_cheque=$_POST["monto_cheque"];
		$tipo_pago=$_POST["tipo_pago"];
		$fecha_vencimiento=date("Y-m-d",strtotime($fecha_vencimiento));

		$sql="INSERT INTO pagos_nacionales (id_cliente,fecha_deposito,monto,numero_documento,tipo_documento)
				VALUES ('$id_cliente_nacional','$fecha_vencimiento','$monto_cheque','$numero_cheque','$tipo_pago')";
 		$resultado=mysql_query($sql,$conexion->link);
		echo "Pago Ingresado";
	}
	else if ($funcion==4)
	{
		$id_cliente_nacional=$_POST["id_cliente_nacional"];
		$fecha_cancelacion=$_POST["fecha_cancelacion"];
		$monto_efectivo=$_POST["monto_efectivo"];
		$tipo_pago=$_POST["tipo_pago"];
		$documento=$_POST["documento"];
		$fecha_cancelacion=date("Y-m-d",strtotime($fecha_cancelacion));

		$sql="INSERT INTO pagos_nacionales (id_cliente,fecha_deposito,monto,numero_documento,tipo_documento)
				VALUES ('$id_cliente_nacional','$fecha_cancelacion','$monto_efectivo','$documento','$tipo_pago')";
 		$resultado=mysql_query($sql,$conexion->link);
		echo "Pago Ingresado";

	}
?>