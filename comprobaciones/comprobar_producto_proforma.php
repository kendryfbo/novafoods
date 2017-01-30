<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);
	if ($funcion==1)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$id_producto=trim($_POST["id_producto"]);
	 
		$sql1="select id_producto from temporal_detalle_proforma
				where numero_proforma='".$numero_proforma."' and id_producto = ".$id_producto;
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
		$numero_proforma=trim($_POST["numero_proforma"]);
		$id_producto=trim($_POST["id_producto"]);
	 
		$sql1="select id_producto from detalle_proforma
				where numero_proforma='".$numero_proforma."' and id_producto = ".$id_producto;
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