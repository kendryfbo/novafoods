<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
    $numero_codigo_barra=trim($_GET["numero_codigo_barra"]);
 

$sql1="select detalle_veredas.kilos,detalle_veredas.img_codigo_barra,productos.nombre_producto,umed.umed 
				from detalle_veredas
				inner join productos on productos.id_producto=detalle_veredas.id_producto
				inner join umed on umed.id_umed=productos.id_umed
				where detalle_veredas.id=".$numero_codigo_barra;
		$resultado1=mysql_query($sql1,$conexion->link);
	 
		while ($mensaje1=mysql_fetch_array ($resultado1))
		{
			$salida[]=array("kilos"=>$mensaje1[0],"imagen"=>$mensaje1[1],"nombre_producto"=>$mensaje1[2],"umed"=>$mensaje1[3]);
		}

		 echo json_encode($salida);
?>