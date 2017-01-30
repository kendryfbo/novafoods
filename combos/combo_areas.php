<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select * from areas  ORDER BY areas  ASC";
        //$sql="select * from sector_productos  where id_sector_producto <> 5 and id_sector_producto <> 4 ORDER BY Sector_producto  ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_area"=>$fila[0],"area"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>