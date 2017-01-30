<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 
	$rut=trim($_POST["rut"]);
	$nombre_cliente=trim($_POST["nombre_cliente"]);
	/*$direccion=trim($_POST["direccion"]);
	$id_region=trim($_POST["id_region"]);
	$id_comuna=trim($_POST["id_comuna"]);*/
	$telefono=trim($_POST["fono"]);
	$id_giro=trim($_POST["id_giro"]);
	$contacto=trim($_POST["contacto"]);
	$id_cargo=trim($_POST["id_cargo"]);
	$fax=trim($_POST["fax"]);
	$email=trim($_POST["email"]);
	$credito=trim($_POST["credito"]);
	$rut = str_replace(".", "", $rut);
	$credito = str_replace(".", "", $credito);
	$id_vendedores=trim($_POST["id_vendedores"]);
        $id_condicion=trim($_POST["id_condicion"]);
        $id_lista_precio=trim($_POST["id_lista_precio"]);
        $id_canal=trim($_POST["id_canal"]);
 
	 try{		
			mysql_query("SET NAMES 'utf8'");
			
                        $sql3="INSERT INTO cliente(nombre,rut,telefono,id_giro,Fax,c1,id_cargo,m1,credito,vendedor,tipo_cliente,pais,canal,cond_pago,tipo_lista)
			VALUES
			('$nombre_cliente','$rut','$telefono','$id_giro','$fax','$contacto','$id_cargo','$email','$credito','$id_vendedores','2','46','$id_canal','$id_condicion','$id_lista_precio')";
                        /*$sql3="INSERT INTO cliente_nacional (nombre_cliente,rut,direccion,id_region,id_comuna,fono,id_giro,Fax,Contacto,id_cargo,email,credito_maximo)
			VALUES
			('$nombre_cliente','$rut','$direccion','$id_region','$id_comuna','$telefono','$id_giro','$fax','$contacto','$id_cargo','$email','$credito')";*/
			$resultado=mysql_query($sql3,$conexion->link);
				
			echo "Cliente Ingresado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		