<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$funcion=trim($_POST["funcion"]);
	if ($funcion==1)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql="select sum(total) as suma
			from temporal_detalle_proforma
			where numero_proforma=".$numero_proforma;
				
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
		if ($mensaje[0]=="")
		{
			echo '0';
		}
		else
		{
			echo  $mensaje[0];
		}
	}
	else if ($funcion==2)
	{	
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql="select sum(total) as suma
			from detalle_proforma
			where numero_proforma=".$numero_proforma;
				
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);

		if ($mensaje[0]=="")
		{
			echo '0';
		}
		else
		{
			echo  $mensaje[0];
		}
	}
        else if ($funcion==3)
	{	
		$id_usuario=trim($_POST["id_usuario"]);
		$sql="select sum(total) as suma
			from temporal_detalle_proforma
			where id_usuario=".$id_usuario;
				
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);

		if ($mensaje[0]=="")
		{
			echo '0';
		}
		else
		{
			echo  $mensaje[0];
		}
	}
?>	