<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select * from tallas  ORDER BY talla ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_talla"=>$fila[0],"talla"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>