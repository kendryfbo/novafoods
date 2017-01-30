<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$rut=trim($_POST["rut"]);
	$nombre_cliente=trim($_POST["nombre_cliente"]);
	$canal=trim($_POST["canal"]);
        $id_giro=trim($_POST["id_giro"]);
	$telefono=trim($_POST["telefono"]);
	$fax=trim($_POST["fax"]);
	$contacto=trim($_POST["contacto"]);
	$cargo=trim($_POST["cargo"]);	
	$email=trim($_POST["email"]);
        $credito=trim($_POST["credito"]);
        $vendedor=trim($_POST["vendedor"]);
	$pago=trim($_POST["pago"]);
        $lista_precio=trim($_POST["lista_precio"]);
        
	$id_cliente=trim($_POST["id_cliente"]);
	
 	$rut = str_replace(".", "", $rut);
	$credito = str_replace(".", "", $credito);
	 try{		
			mysql_query("SET NAMES 'utf8'");
			$sql1="UPDATE cliente
				set 		 
                                rut='".$rut."',
				nombre='".utf8_decode($nombre_cliente)."',
				canal='".$canal."',
                                id_giro='".$id_giro."',
                                telefono='".$telefono."',
                                fax='".$fax."',
                                c1='".utf8_decode($contacto)."',
				id_cargo='".utf8_decode($cargo)."',
                                m1='".utf8_decode($email)."',
				credito='".$credito."',
                                vendedor='".$vendedor."',
                                cond_pago='".$pago."',
                                tipo_lista='".$lista_precio."'
				where id_cliente=".$id_cliente;
                        /*$sql1="UPDATE cliente_nacional set nombre_cliente='".utf8_decode($nombre_cliente)."',
				rut='".$rut."',direccion='".utf8_decode($direccion)."',id_region='".$id_region."',
				id_comuna='".$id_comuna."',id_giro='".$id_giro."',Fax='".$fax."',
				Contacto='".utf8_decode($contacto)."',id_cargo='".utf8_decode($cargo)."',
				fono='".$telefono."',email='".utf8_decode($email)."',
				credito_maximo='".$credito."'where id_cliente=".$id_cliente;*/
			$resultado2=mysql_query($sql1,$conexion->link);
			echo "Cliente Actualizado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		