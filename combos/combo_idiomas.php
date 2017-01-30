<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select * from idiomas ORDER BY idioma ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_idioma"=>$fila[0],"idioma"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>