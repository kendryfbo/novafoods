<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_usuario=$_POST["id_usuario"];
 	$clave=trim($_POST["clave"]);
	
	try{
			$sql1="UPDATE usuarios	 
				set 		 
				clave_aprobacion_gerencia='".utf8_decode($clave)."'
				where id_Usuario=".$id_usuario;

			$resultado2=mysql_query($sql1,$conexion->link);
	
			echo "Clave Actualizada";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		