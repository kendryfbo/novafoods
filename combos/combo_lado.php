<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select lado from bodega  group by lado ORDER BY lado ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("lado"=>$fila[0]);
                //$salida[]=array("id_lado"=>$fila[0],"lado"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>