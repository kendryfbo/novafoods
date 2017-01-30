<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
  	$numero_oc=trim($_POST["numero_oc"]);
	$id_producto=trim($_POST["id_producto"]);
        $id_usuario=trim($_POST["id_usuario"]);
        
	$funcion=trim($_POST["funcion"]);
	if ($funcion==1)
	{
		$sql1="select id_producto from detalle_oc
				where id_oc=".$numero_oc." and id_producto = ".$id_producto;
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
		
		$sql1="select id_producto from temporal_det_oc
				where id_usuario='".$id_usuario."' and id_producto = ".$id_producto;
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
        else if ($funcion==3)
	{
		
		$sql1="select id_producto from temporal_detalle_nc
				where id_usuario='".$numero_nota_venta."' and id_producto = ".$id_producto;
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