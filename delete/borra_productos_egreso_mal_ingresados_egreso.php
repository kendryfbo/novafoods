<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);

	if ($funcion==1)
	{
		$id_detalle_egreso=trim($_POST["id_detalle_egreso"]);

		try{
	 
		$sql="DELETE FROM detalle_productos_egreso	
		WHERE id_detalle_egreso=".$id_detalle_egreso;

		$resultado=mysql_query($sql,$conexion->link);		

		}
			catch (Exception $e)
		{  
		
			echo $e->getMessage();
		}		 
	}
	else if ($funcion==2)
	{
		$id_detalle_ingreso=trim($_POST["id_detalle_ingreso"]);

		try{
	 
		$sql="DELETE FROM detalle_ingreso_manual_pop	
		WHERE id_detalle_manual	=".$id_detalle_ingreso;

		$resultado=mysql_query($sql,$conexion->link);		

		}
			catch (Exception $e)
		{  
		
			echo $e->getMessage();
		}	
	}	
?>	