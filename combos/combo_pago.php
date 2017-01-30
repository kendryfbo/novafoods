<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();

	$sql="select * from condiciones_pago";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{	
		$salida[]=array("id_condicion"=>$fila[0],"condicion"=>utf8_encode($fila[1]));
	}
	echo json_encode($salida);

?>