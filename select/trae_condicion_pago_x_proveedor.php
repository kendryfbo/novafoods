<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();
	$tipo_proveedor=$_POST["tipo_proveedor"];
	$id_proveedor=$_POST["id_proveedor"];
	

	if ($tipo_proveedor==1)
	{


		$sql="select condicion_de_pago from proveedores_nacionales where id_proveedor=".$id_proveedor;
		$ejecuta=mysql_query($sql,$conexion->link);
		 
		 
		while ($fila = mysql_fetch_array($ejecuta))
		{
			
			
			echo utf8_encode($fila[0]);

		}
 
	}
	else
	{
		$sql="select condicion_de_pago from proveedores_internacionales where id_proveedor=".$id_proveedor;
		$ejecuta=mysql_query($sql,$conexion->link);
		 
		 
		while ($fila = mysql_fetch_array($ejecuta))
		{
			
				echo utf8_encode($fila[0]);

		}
			


	}


?>