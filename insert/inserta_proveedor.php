<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$rut=trim($_POST["rut"]);
	$proveedor=trim($_POST["proveedor"]);
	$direccion=trim($_POST["direccion"]);
        $id_region=trim($_POST["id_region"]);
	$id_prov=trim($_POST["id_prov"]);
	$id_comuna=trim($_POST["id_comuna"]);
	$fono=trim($_POST["fono"]);
        $fax=trim($_POST["fax"]);
        $giro=trim($_POST["giro"]);
        $contacto=trim($_POST["contacto"]);
        $id_cargo=trim($_POST["id_cargo"]);
        $celular=trim($_POST["celular"]);
	$email=trim($_POST["email"]);
	$cond_pago=trim($_POST["cond_pago"]);
	$contacto_cobra=trim($_POST["contacto_cobra"]);
	$email2=trim($_POST["email2"]);
        $tipo=trim($_POST["tipo"]);
	$rut = str_replace(".", "", $rut);

	 try{		
			mysql_query("SET NAMES 'utf8'");
			$sql3="INSERT INTO proveedor (rut,nombre,direccion,id_reg,id_prov,id_com,fono,fax,giro,contacto1,id_cargo,celular,mail1,cond_pago,contacto2,mail2,tipo,habilitado)
			VALUES
			('$rut','$proveedor','$direccion','$id_region','$id_prov','$id_comuna','$fono','$fax','$giro','$contacto','$id_cargo','$celular','$email','$cond_pago','$contacto_cobra','$email2','$tipo','S')";
                        /*$sql3="INSERT INTO proveedores_nacionales (nombre_proveedor,rut_proveedor,direccion	,id_comuna,id_region,fono,giro,Fax,Contacto,id_cargo,email,Celular,condicion_de_pago)
			VALUES
			('$proveedor','$rut','$direccion','$id_comuna','$id_region','$fono','$giro','$fax','$contacto','$id_cargo','$email','$celular','$cond_pago')";*/
			$resultado=mysql_query($sql3,$conexion->link);
				//echo$sql3;
			echo "Proveedor Ingresado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		