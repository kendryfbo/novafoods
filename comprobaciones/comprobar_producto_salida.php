<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);

	if ($funcion==1)
	{
		$id_producto=trim($_POST["id_producto"]);
		$num_egreso=trim($_POST["num_egreso"]); 
		$sql1="select id_producto from detalle_productos_egreso
				where id_egreso='".$num_egreso."' and id_producto = ".$id_producto;
		$resultado=mysql_query($sql1,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
		
		if ($mensaje[0]<>"")
		{
			echo "Error";
			return false;
		}
		else
		{
			echo "Ok";
		}
	}
	else if ($funcion==2)
	{
		$id_producto=trim($_POST["id_producto"]);
		$num_ingreso=trim($_POST["num_ingreso"]); 
		$sql1="select id_producto from detalle_ingreso_manual_pop
				where id_ingreso='".$num_ingreso."' and id_producto = ".$id_producto;
		$resultado=mysql_query($sql1,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
		
		if ($mensaje[0]<>"")
		{
			echo "Error";
			return false;
		}
		else
		{
			echo "Ok";
		}

	}	
?>	