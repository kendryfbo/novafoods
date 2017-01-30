<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select * from suc_aduanas";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_suc_aduanas"=>$fila[0],"direccion"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>