<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$clave=$_POST["clave"];
	$id_usuario=$_POST["id_usuario"];
 	 
	try{
			$sql1="UPDATE usuarios	 
				set 		 
				clave_aprobacion_gerencia='".utf8_decode($clave)."'
				where id_Usuario=".$id_usuario;

			$resultado2=mysql_query($sql1,$conexion->link);
	
			echo "Clave Ingresada";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		