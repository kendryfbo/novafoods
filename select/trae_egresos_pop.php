<?php
	$valor=$_POST["valor"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	
	if ($valor==1)
	{	
		$sql1="select 
				DATE_FORMAT(fecha, '%d/%m/%y') as fecha,
				id_egreso
				from egresos
				where  rechazado_gerencia='Si' and ingresado='Si'";
		$ejecuta=mysql_query($sql1,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas<>0)
		{
			while ($fila=mysql_fetch_array($ejecuta))
			{
				echo "<tr>
						<td>".$fila[1]."</td>
						<td>".$fila[0]."</td>
					</tr>";
			}
		}
		else 
		{
			echo "No Exiten Egresos Rechazados";
		}
	}
	else if ($valor==2)
	{
		$sql1="select 
				DATE_FORMAT(fecha, '%d/%m/%y') as fecha,
				id_egreso
				from egresos
				where aceptado_gerencia='Si' and sacado_stock='' and rechazado_gerencia=''";
		$ejecuta=mysql_query($sql1,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas<>0)
		{
			while ($fila=mysql_fetch_array($ejecuta))
			{
				echo "<tr>
						<td>".$fila[1]."</td>
						<td>".$fila[0]."</td>
					</tr>";
			}
		}
		else 
		{
			echo "No Exiten Egresos Aceptados Por Gerencia";
		}
	}
	else if ($valor==3)
	{
		$sql="select bodega_pop.id_producto,
		productos.nombre_producto,
		umed.umed
		FROM bodega_pop 
		inner join productos on bodega_pop.id_producto=productos.id_producto
		inner join umed on umed.id_umed=umed.id_umed
		group by bodega_pop.id_producto";
		$ejecuta=mysql_query($sql,$conexion->link);
		while ($fila=mysql_fetch_array($ejecuta))
		{
			$sql1="SELECT IFNULL((SELECT SUM(bodega_pop.cantidad)FROM bodega_pop where bodega_pop.id_producto='".$fila[0]."'),0) AS suma_bod
			 ";
			$ejecuta1=mysql_query($sql1,$conexion->link);
			while ($fila1=mysql_fetch_array($ejecuta1))
			{
				echo "<tr>
				 		<td>".utf8_encode($fila[1])."</td>
						<td>".$fila1[0]."</td>
						 <td>".$fila[2]."</td>
				 							
						
				 
						 
					</tr>";
			}
		}
	}
?>