<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 
	$sucursal=trim($_POST["sucursal"]);
	$id_region=trim($_POST["id_region"]);
	$id_providencia=trim($_POST["id_providencia"]);
	$id_comuna=trim($_POST["id_comuna"]);
        $id_cliente=trim($_POST["id_cliente"]);
	
	 try{		
			mysql_query("SET NAMES 'utf8'");
			
                        $sql3="INSERT INTO suc_clientes(suc_cliente,cliente,region,provincia,comuna)
			VALUES
			('$sucursal','$id_cliente','$id_region','$id_providencia','$id_comuna')";
                        /*$sql3="INSERT INTO cliente_nacional (nombre_cliente,rut,direccion,id_region,id_comuna,fono,id_giro,Fax,Contacto,id_cargo,email,credito_maximo)
			VALUES
			('$nombre_cliente','$rut','$direccion','$id_region','$id_comuna','$telefono','$id_giro','$fax','$contacto','$id_cargo','$email','$credito')";*/
			$resultado=mysql_query($sql3,$conexion->link);
				
			echo "Sucursal Ingresada";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		