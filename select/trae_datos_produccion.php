<?php
	$id_produccion=$_POST["id_produccion"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$sql1="select DATE_FORMAT(produccion.fecha_produccion, '%d/%m/%y'),produccion.turno,marcas.marca,
	formatos.formato,productos.codigo_producto,produccion.lote,produccion.unidades_producidas,sabores.sabor_espanol,produccion.numero_pallet,
	 DATE_FORMAT(produccion.fecha_vencimiento, '%d/%m/%y'),productos.id_familia,productos.id_producto
	from produccion 
	inner join productos on productos.id_producto=produccion.id_producto
	inner join marcas on productos.id_marca=marcas.id_marca
	inner join formatos on productos.id_formato=formatos.id_formato
	inner join sabores on productos.id_sabor=sabores.id_sabor
	WHERE produccion.id_produccion =".$id_produccion;
 	 	
	$ejecuta=mysql_query($sql1,$conexion->link);

	while ($fila = mysql_fetch_array($ejecuta))
	{
		$salida[]=array("fecha_produccion"=>$fila[0],"turno"=>$fila[1],"marca"=>$fila[2],"formato"=>$fila[3],"codigo_producto"=>$fila[4],
			"lote"=>$fila[5],"unidades"=>$fila[6],"sabor"=>$fila[7],"numero_pallet"=>$fila[8],"fecha_vencimiento"=>$fila[9],"id_familia"=>$fila[10],
			"id_producto"=>$fila[11]);
	}
	echo json_encode($salida);
?>