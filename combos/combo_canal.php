<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select * from canales  ORDER BY canal ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_canal"=>$fila[0],"canal"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>