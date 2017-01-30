<?php
	$numero_orden=$_POST["numero_orden"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
	$sql1="select 
			DATE_FORMAT(fecha_orden_compra, '%d/%m/%y') as fecha,
			estados_orden_de_compra.estado_orden_compra
			from orden_compra
			inner join estados_orden_de_compra on estados_orden_de_compra.id_estado_orden_compra=orden_compra.id_estado_orden_compra
			where orden_compra.numero_orden_compra=".$numero_orden;
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
 			$fila=mysql_fetch_array($ejecuta);
			if ($fila<>"")
			{
				echo "<tr><br><br><th  BGCOLOR='#A4A4A4'>Fecha</th><th BGCOLOR='#A4A4A4'>Estado de la Orden</th><th BGCOLOR='#A4A4A4'>Imprimir</th></tr>"; 
				echo "<td id='".$numero_orden."' >".$fila[0]."</td>";
				echo "<td>".$fila[1]."</td>"; 
				echo"<td class='width10' ><a href='#' onClick='$(this).orden_compra_imprimir();' title='Ver Informacion' class='icon-ver info-tooltip'></a></td>";
			  
			}
			else
			{
		 		echo "<td>Orden de Compra No Existe</td>"; 
				 
			}
				
?>