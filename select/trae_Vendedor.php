<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$id_vendedor=trim($_GET["id_vendedor"]);
 
	$sql1="select 
	*
	from vendedores 
	where id_vendedor=".$id_vendedor;
	$ejecuta=mysql_query($sql1,$conexion->link);
	while ($fila = mysql_fetch_array($ejecuta))
	{
		$salida[]=array("vendedor"=>utf8_encode($fila[1]),"iniciales"=>utf8_encode($fila[2]));
	}
	echo json_encode($salida);
?>