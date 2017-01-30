<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$nombre_cliente=trim($_POST["nombre_cliente"]);
	$id_pais=trim($_POST["id_pais"]);
	$direccion=trim($_POST["direccion"]);
	$telefono=trim($_POST["telefono"]);
	$id_idioma=trim($_POST["id_idioma"]);
	$email=trim($_POST["email"]);
	$id_cliente_int=trim($_POST["id_cliente_int"]);
	$contacto=trim($_POST["contacto"]);
 	$rut=trim($_POST["rut"]);
	$credito=trim($_POST["credito"]);
	$credito = str_replace(".", "", $credito);
	 try{		
			
			mysql_query("SET NAMES 'utf8'");
			$sql1="UPDATE cliente_internacional	 
				set 
				rut='".$rut."',
				nombre_cliente='".utf8_decode($nombre_cliente)."',
				direccion='".utf8_decode($direccion)."',
				id_pais='".$id_pais."',
				email='".$email."',
				fono='".$telefono."',
				contacto='".$contacto."',
				id_idioma='".$id_idioma."',
				credito_maximo='".$credito."'
				where id_cliente=".$id_cliente_int;
			$resultado2=mysql_query($sql1,$conexion->link);			
			echo "Cliente Actualizado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		