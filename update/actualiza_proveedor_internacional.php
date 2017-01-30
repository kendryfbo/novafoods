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
	$id_proveedor=trim($_POST["id_proveedor"]);
 	//$rut=trim($_POST["rut"]);

	 try{		
			mysql_query("SET NAMES 'utf8'");
			$sql1="UPDATE proveedor	 
				set 		 
				nombre='".utf8_decode($proveedor)."',
				direccion='".utf8_decode($direccion)."',
				id_pais='".$id_pais."',
				fono='".$fono."',
                                fax='".$fax."',    
				giro='".$giro."',
				contacto1='".$contacto."',
				id_cargo='".$id_cargo."',
                                celular='".$celular."',
				mail1 ='".$email."',
				cond_pago='".$cond_pago."',
                                contacto2='".$contacto2."',
				mail2='".$email2."'
				where id_proveedor=".$id_proveedor;
                        /*$sql1="UPDATE proveedores_internacionales	 
				set 		 
				nombre_proveedor='".utf8_decode($proveedor)."',
				direccion='".utf8_decode($direccion)."',
				id_pais='".$id_pais."',
				telefono='".$fono."',
				giro='".$giro."',
				Contacto='".$contacto."',
				id_cargo='".$id_cargo."',
				email='".$email."',
				rut='".$rut."',
				condicion_de_pago='".$cond_pago."'	
				where id_proveedor=".$id_proveedor;*/
			$resultado=mysql_query($sql1,$conexion->link);
				
				
			echo "Proveedor Actualizado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>	