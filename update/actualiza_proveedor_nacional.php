<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$id_proveedor=trim($_POST["id_proveedor"]);
	$rut=trim($_POST["rut"]);
	$proveedor=trim($_POST["proveedor"]);
	$direccion=trim($_POST["direccion"]);
	$id_region=trim($_POST["id_region"]);
        $id_provincia=trim($_POST["id_provincia"]);
	$id_comuna=trim($_POST["id_comuna"]);
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
        
	//$rut = str_replace(".", "", $rut);

	 try{		
			mysql_query("SET NAMES 'utf8'");
 			$sql1="UPDATE proveedor
				set 		 
				nombre='".utf8_decode($proveedor)."',
				direccion='".$direccion."',
                                id_reg='".$id_region."',
                                id_prov='".$id_provincia."',
				id_com='".$id_comuna."',				
				fono='".$fono."',
                                Fax='".$fax."',
				giro='".$giro."',
				contacto1='".$contacto."',
				id_cargo='".$id_cargo."',
				Celular='".$celular."',
                                mail1='".$email."',
				cond_pago='".$cond_pago."',
                                contacto2='".$contacto2."',
                                mail2='".$email2."'       
				where id_proveedor=".$id_proveedor;
                        /*$sql1="UPDATE proveedores_nacionales	 
				set 		 
				nombre_proveedor='".utf8_decode($proveedor)."',
				rut_proveedor='".utf8_decode($rut)."',
				direccion='".$direccion."',
				id_comuna='".$id_comuna."',
				id_region='".$id_region."',
				fono='".$fono."',
				giro='".$giro."',
				Fax='".$fax."',
				id_cargo='".$id_cargo."',
				Celular='".$celular."',
				condicion_de_pago='".$cond_pago."'
				where id_proveedor=".$id_proveedor;*/
			$resultado2=mysql_query($sql1,$conexion->link);			
			echo "Cliente Actualizado";
			
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		