<?php
	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();

	$id_usuario=$_POST["id_usuario"];
 
try{
	 
		$sql="DELETE FROM usuarios	
		WHERE id_Usuario=".$id_usuario;

		$resultado=mysql_query($sql,$conexion->link);
		

		echo "Usuario Borrado";
	}
		catch (Exception $e)
	{  
	
		echo $e->getMessage();
	}	
				
?>