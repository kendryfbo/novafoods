<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select * from sector_productos where habilitado = 's'   ORDER BY Sector_producto ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_sector"=>$fila[0],"sector"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>