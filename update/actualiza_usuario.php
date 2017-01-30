<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	
 
 	$rut=trim($_POST["rut"]);
	$usuario=trim($_POST["usuario"]);
	$nombre=trim($_POST["nombre"]);
	$password=trim($_POST["password"]);
	$apellido=trim($_POST["apellido"]);
	$email=trim($_POST["email"]);
	$id_usuario_modificar=trim($_POST["id_usuario_modificar"]);
	$id_tipo_usuario=trim($_POST["id_tipo_usuario"]);
	$id_sector_usuario=trim($_POST["id_sector_usuario"]);
	
	try{
			$sql1="UPDATE usuarios	 
			set 		 
			usuario='".$usuario."',
			password='".$password."',
			email='".$email."',
			Nombre='".$nombre."',
			apellido='".$apellido."',
			rut='".$rut."',
			id_tipo_usuario=".$id_tipo_usuario.",
			id_sector=".$id_sector_usuario."
			where id_Usuario=".$id_usuario_modificar;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Usuario Actualizado";
					 
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}


					
?>	