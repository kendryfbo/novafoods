<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$numero=trim($_GET["numero"]);
	
	$sql1="select productos.nombre_producto,detalle_veredas.kilos,umed.umed
	from detalle_veredas 
	inner join productos on productos.id_producto=detalle_veredas.id_producto
	inner join umed on umed.id_umed=productos.id_umed
	WHERE detalle_veredas.id=".$numero;
	$ejecuta1=mysql_query($sql1,$conexion->link);
	while ($fila = mysql_fetch_array($ejecuta1))
	{
		$salida[]=array("nombre_producto"=>$fila[0],"kilos"=>$fila[1],"numero"=>$numero,"umed"=>$fila[2]);
	}
	echo json_encode($salida);
?>
