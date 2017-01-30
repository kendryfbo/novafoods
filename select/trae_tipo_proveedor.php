<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();
	$tipo_proveedor=$_GET["tipo_proveedor"];

	if ($tipo_proveedor==1)
	{


		$sql="select id_proveedor,nombre_proveedor from proveedores_nacionales  ORDER BY nombre_proveedor ASC";
		$ejecuta=mysql_query($sql,$conexion->link);
		 
		 
		while ($fila = mysql_fetch_array($ejecuta))
		{
			
			
			$salida[]=array("id_proveedor"=>$fila[0],"nombre_proveedor"=>utf8_encode($fila[1]));

		}
		echo json_encode($salida);
	}
	else
	{
		$sql="select id_proveedor,nombre_proveedor from proveedores_internacionales  ORDER BY nombre_proveedor ASC";
		$ejecuta=mysql_query($sql,$conexion->link);
		 
		 
		while ($fila = mysql_fetch_array($ejecuta))
		{
			
			
			$salida[]=array("id_proveedor"=>$fila[0],"nombre_proveedor"=>utf8_encode($fila[1]));

		}
		echo json_encode($salida);
		


	}


?>