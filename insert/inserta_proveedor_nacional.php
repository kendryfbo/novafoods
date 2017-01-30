<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$rut=trim($_POST["rut"]);
	$proveedor=trim($_POST["proveedor"]);
	$direccion=trim($_POST["direccion"]);
	$id_region=trim($_POST["id_region"]);
	$id_comuna=trim($_POST["id_comuna"]);
	$fono=trim($_POST["fono"]);
	$celular=trim($_POST["celular"]);
	$giro=trim($_POST["giro"]);
	$id_cargo=trim($_POST["id_cargo"]);
	$email=trim($_POST["email"]);
	$cond_pago=trim($_POST["cond_pago"]);
	$fax=trim($_POST["fax"]);
	$contacto=trim($_POST["contacto"]);
	$rut = str_replace(".", "", $rut);

	 try{		
			mysql_query("SET NAMES 'utf8'");
			$sql3="INSERT INTO proveedores_nacionales (nombre_proveedor,rut_proveedor,direccion	,id_comuna,id_region,fono,giro,Fax,Contacto,id_cargo,email,Celular,condicion_de_pago)
			VALUES
			('$proveedor','$rut','$direccion','$id_comuna','$id_region','$fono','$giro','$fax','$contacto','$id_cargo','$email','$celular','$cond_pago')";
			$resultado=mysql_query($sql3,$conexion->link);
				
			echo "Proveedor Ingresado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		