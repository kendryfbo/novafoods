<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
  	$numero_orden=trim($_POST["numero_orden"]);
	$sql="select
			productos.nombre_producto,
			productos.id_producto,
			temporal.cantidad
		from temporal
		inner join  detalle_productos_orden_compra on	temporal.id_pedido=detalle_productos_orden_compra.id_pedido_orden_compra
		inner join  productos on productos.id_producto=detalle_productos_orden_compra.id_producto
		where temporal.numero_orden_compra=".$numero_orden. " group by productos.nombre_producto" ;
	$resultado=mysql_query($sql,$conexion->link);
	$numero_filas = mysql_num_rows($resultado);
	if ($numero_filas<>0)
	{
				echo	"<thead>"; 
				echo	"<tr>";												 
				echo	"<th>Producto</th>";
				echo	"<th>Cantidad</th>";		
				echo	"</thead>"; 
				echo	"</tr>";

		while ($mensaje=mysql_fetch_array($resultado))
		{		
											 
				echo	"<tbody>";						 
				echo	"<tr id=".$mensaje[0].">";
				echo	"<td>".utf8_encode($mensaje[0])."</td>";
				echo	"<td>".$mensaje[2]."</td>";
				echo	"</tr>";
				echo	"</tbody>";
		}
	}
?>	