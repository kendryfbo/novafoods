<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
  	$clave=trim($_POST["clave"]);
	$id_usuario=trim($_POST["id_usuario"]);
	
	$sql1="select clave_aprobacion_gerencia from usuarios
			where id_Usuario=".$id_usuario;
	$resultado=mysql_query($sql1,$conexion->link);
	$mensaje=mysql_fetch_array($resultado);
	
	if (trim($mensaje[0])<> $clave)
	{
		echo "Error";
		return false;
	}
	else
	{
		echo "Ok";
	}	
	
		
?>	