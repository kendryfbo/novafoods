<?php	 
	include_once("../clases/conexion.php");
	$id_region=$_GET["id_region"];
	$conexion=new conexion();


	$sql="select id_comuna,comuna from comunas where id_region=".$id_region. " ORDER BY comuna ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_comuna"=>$fila[0],"comuna"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>