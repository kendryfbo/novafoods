<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
 	$rut=trim($_POST["rut"]);	 
 	$id_usuario_modificar=trim($_POST["id_usuario_modificar"]);

	if ($id_usuario_modificar<>"undefined")
	{		
		$sql1="select rut from usuarios
		where rut='".$rut."' and id_usuario!=".$id_usuario_modificar;

		$resultado=mysql_query($sql1,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
	}
	else
	{
		$sql1="select rut from usuarios
			where rut='".$rut."'";
		$resultado=mysql_query($sql1,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
	}

	if ($mensaje[0]<>"")
	{
		echo "Error";
		return false;

	}
	else
	{				 
			echo "Ok";
	}

	
 			
?>	