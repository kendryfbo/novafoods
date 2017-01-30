<?php	
	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
 	$rut=trim($_POST["rut"]);
	$usuario=trim($_POST["usuario"]);
	$nombre=trim($_POST["nombre"]);
	$password=trim($_POST["password"]);
	$apellido=trim($_POST["apellido"]);
	$email=trim($_POST["email"]);
	$id_tipo_usuario=trim($_POST["id_tipo_usuario"]);
	$id_sector_usuario=trim($_POST["id_sector_usuario"]);
	
   try{		
			mysql_query("SET NAMES 'utf8'");
			$sql3="INSERT INTO usuarios (usuario,password,id_estado,email,Nombre,apellido,Rut,id_tipo_usuario,id_sector)
			VALUES ('$usuario','$password',1,'$email','$nombre','$apellido','$rut','$id_tipo_usuario','$id_sector_usuario')";
			$resultado=mysql_query($sql3,$conexion->link);
								
			echo "Usuario Ingresado";
							
	}
		catch (Exception $e)
	{    
		echo $e->getMessage();
	}


					
?>		