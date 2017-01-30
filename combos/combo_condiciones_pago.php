<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select * from condiciones_pago  ORDER BY id_condicion ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("Numero"=>$fila[0],"Condicion"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>