<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$nombre_cliente=trim($_POST["nombre_cliente"]);
	$tip_emp=trim($_POST["tip_emp"]);
	$id_pais=trim($_POST["id_pais"]);
	$direccion=trim($_POST["direccion"]);
	$telefono=trim($_POST["telefono"]);
	$fax=trim($_POST["fax"]);
	$web=trim($_POST["web"]);
	$categoria=trim($_POST["categoria"]);
	$condicion_venta=trim($_POST["condicion_venta"]);
	$credito=trim($_POST["credito"]);
	$moneda=trim($_POST["moneda"]);
	$id_idioma=trim($_POST["id_idioma"]);

	$contacto_1=trim($_POST["contacto1"]);
	$email1=trim($_POST["email1"]);
	$fono_1=trim($_POST["fono1"]);
	$fecha1=trim($_POST["fecha1"]);

	$contacto_2=trim($_POST["contacto2"]);
	$email2=trim($_POST["email2"]);
	$fono_2=trim($_POST["fono2"]);
	$fecha2=trim($_POST["fecha2"]);

	$contacto_3=trim($_POST["contacto3"]);
	$email3=trim($_POST["email3"]);
	$fono_3=trim($_POST["fono3"]);
	$fecha3=trim($_POST["fecha3"]);

	$contacto_4=trim($_POST["contacto4"]);
	$email4=trim($_POST["email4"]);
	$fono_4=trim($_POST["fono4"]);
	$fecha4=trim($_POST["fecha4"]);

	$contacto_5=trim($_POST["contacto5"]);
	$email5=trim($_POST["email5"]);
	$fono_5=trim($_POST["fono5"]);
	$fecha5=trim($_POST["fecha5"]);

	$contacto_6=trim($_POST["contacto6"]);
	$email6=trim($_POST["email6"]);
	$fono_6=trim($_POST["fono6"]);
	$fecha6=trim($_POST["fecha6"]);

	
	//$credito = str_replace(".", "", $credito);
	 try{		
			mysql_query("SET NAMES 'utf8'");
			$sql3="INSERT INTO cliente (nombre,tipo_empresa,pais,direccion,telefono,fax,pagina_web,categoria,cond_pago,credito,moneda,idioma,
			c1,m1,fo1,fe1,
			c2,m2,fo2,fe2,
			c3,m3,fo3,fe3,
			c4,m4,fo4,fe4,
			c5,m5,fo5,fe5,
			c6,m6,fo6,fe6,
			tipo_cliente)
			VALUES
			('$nombre_cliente','$tip_emp','$id_pais','$direccion','$telefono','$fax','$web','$categoria','$condicion_venta','$credito','$moneda','$id_idioma',
			'$contacto_1','$email1','$fono_1','$fecha1',
			'$contacto_2','$email2','$fono_2','$fecha2',
			'$contacto_3','$email3','$fono_3','$fecha3',
			'$contacto_4','$email4','$fono_4','$fecha4',
			'$contacto_5','$email5','$fono_5','$fecha5',
			'$contacto_6','$email6','$fono_6','$fecha6',
			'1')";

			/*
			$sql3="INSERT INTO cliente (nombre,tipo_empresa,pais,direccion,telefono,fax,pagina_web,categoria,cond_pago,credito,moneda,idioma
			contacto1,mail1,fono1,fec_nacimiento1,contacto2,mail2,fono2,fec_nacimiento2,contacto3,mail3,fono3,fec_nacimiento3,contacto4,mail4,fono4,fec_nacimiento4,
			contacto5,mail5,fono5,fec_nacimiento5,contacto6,mail6,fono6,fec_nacimiento6,tipo_cliente)
			VALUES
			('$nombre_cliente','$tip_emp','$id_pais','$direccion','$telefono','$fax','$web','$categoria','$condicion_venta','$credito','$moneda','$id_idioma',
			'$contacto1','$email1','$fono1','$fecha1','$contacto2','$email2','$fono2','$fecha2','$contacto3','$email3','$fono3','$fecha3','$contacto4','$email4','$fono4','$fecha4',
			'$contacto5','$email5','$fono5','$fecha5','$contacto6','$email6','$fono6','$fecha6','1')";


			$sql3="INSERT INTO cliente_internacional (nombre_cliente,rut,direccion,id_pais,email,fono,id_idioma,contacto,credito_maximo)
			VALUES
			('$nombre_cliente','$rut','$direccion','$id_pais','$email','$telefono','$id_idioma','$contacto','$credito')";
			*/
			$resultado=mysql_query($sql3,$conexion->link);
			echo $sql3;	
			echo "Cliente Ingresado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		