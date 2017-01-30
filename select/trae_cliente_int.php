<?php
	$id_cliente_int=$_GET["id_cliente_int"];
	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$sql1="select 
		nombre_cliente,
		direccion,
		email,
		fono,
		contacto,
		rut,
		credito_maximo
		from cliente_internacional 
		where id_cliente=".$id_cliente_int;
 	$ejecuta=mysql_query($sql1,$conexion->link);
	while ($fila = mysql_fetch_array($ejecuta))
	{
		$salida[]=array("nombre_cliente"=>utf8_encode($fila[0]),"direccion"=>utf8_encode($fila[1]),"email"=>$fila[2],"fono"=>$fila[3],"contacto"=>$fila[4],"rut"=>$fila[5],"credito"=>$fila[6]);
	}
	echo json_encode($salida);
	 
		 


?>