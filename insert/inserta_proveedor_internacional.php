<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
 
	$proveedor=trim($_POST["proveedor"]);
	$direccion=trim($_POST["direccion"]);
	$id_pais=trim($_POST["id_pais"]);
 	$fono=trim($_POST["fono"]);
        $fax=trim($_POST["fax"]);
	$giro=trim($_POST["giro"]);
        $contacto=trim($_POST["contacto"]);
	$id_cargo=trim($_POST["id_cargo"]);
        $celular=trim($_POST["celular"]);
	$email=trim($_POST["email"]);
	$cond_pago=trim($_POST["cond_pago"]);
	$contacto2=trim($_POST["contacto2"]);
        $email2=trim($_POST["email2"]);
 	//$rut=trim($_POST["rut"]);
       

	 try{		
			mysql_query("SET NAMES 'utf8'");
			$sql3="INSERT INTO proveedor(nombre,direccion,id_pais,fono,fax,giro,contacto1,id_cargo,celular,mail1,cond_pago,contacto2,mail2,tipo,habilitado)
			VALUES
			('$proveedor','$direccion','$id_pais','$fono','$fax','$giro','$contacto','$id_cargo','$celular','$email','$cond_pago','$contacto2','$email2','1','S')";
                        /*$sql3="INSERT INTO proveedores_internacionales (nombre_proveedor,rut,direccion,id_pais,telefono,giro,Contacto,id_cargo,email,condicion_de_pago)
			VALUES
			('$proveedor','$rut','$direccion','$id_pais','$fono','$giro','$contacto','$id_cargo','$email','$cond_pago')";*/
			$resultado=mysql_query($sql3,$conexion->link);
			//echo $sql3;	
			echo "Proveedor Ingresado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>	