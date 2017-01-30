<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();


	$sql="select * from vendedores  where habilitado<>'n' ORDER BY vendedor ASC";
	$ejecuta=mysql_query($sql,$conexion->link);
	 
	 
	while ($fila = mysql_fetch_array($ejecuta))
	{
		
		
		$salida[]=array("id_vendedor"=>$fila[0],"vendedor"=>utf8_encode($fila[1]));

	}
	echo json_encode($salida);


?>