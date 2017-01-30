<?php
	$id_proveedor_nacional=$_GET["id_proveedor_nacional"];
	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$sql1="select 
			proveedor.nombre,
			proveedor.rut,
			proveedor.direccion,
			proveedor.fono,
			proveedor.giro,
			proveedor.Fax,
			proveedor.Contacto1,
			proveedor.mail1,
			proveedor.Celular,
			condiciones_pago.Condicion,
                        region_cl.id_re,
                        cargos.cargo,
                        proveedor.contacto2,
			proveedor.mail2
			from proveedor
                        inner join condiciones_pago on condiciones_pago.id_condicion=proveedor.cond_pago
                        inner join region_cl on region_cl.id_re=proveedor.id_reg
                        inner join cargos on cargos.id_cargo=proveedor.id_cargo
			where proveedor.id_proveedor=".$id_proveedor_nacional;
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
			while ($fila = mysql_fetch_array($ejecuta))
			{
				
			$salida[]=array("nombre"=>utf8_encode($fila[0]),"rut"=>utf8_encode($fila[1]),"direccion"=>$fila[2],"fono"=>$fila[3],"giro"=>$fila[4],"Fax"=>$fila[5],"Contacto"=>$fila[6],"email"=>$fila[7],"Celular"=>$fila[8],"condicion_de_pago"=>$fila[9]
                                ,"region"=>$fila[10],"carg"=>$fila[11],"contacto2"=>$fila[12],"email2"=>$fila[13]);
                        //$salida[]=array("nombre"=>utf8_encode($fila[0]),"rut"=>utf8_encode($fila[1]),"direccion"=>$fila[2],"fono"=>$fila[3],"giro"=>$fila[4],"Fax"=>$fila[5],"Contacto"=>$fila[6],"email"=>$fila[7],"Celular"=>$fila[8],"condicion_de_pago"=>$fila[9]);
			}
			echo json_encode($salida);
	 /*$sql1="select 
			nombre_proveedor,
			rut_proveedor,
			direccion,
			fono,
			giro,
			Fax,
			Contacto,
			email,
			Celular,
			condicion_de_pago
			from proveedores_nacionales 
			where id_proveedor=".$id_proveedor_nacional;
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
			while ($fila = mysql_fetch_array($ejecuta))
			{
				
			$salida[]=array("nombre_proveedor"=>utf8_encode($fila[0]),"rut_proveedor"=>utf8_encode($fila[1]),"direccion"=>$fila[2],"fono"=>$fila[3],"giro"=>$fila[4],"Fax"=>$fila[5],"Contacto"=>$fila[6],"email"=>$fila[7],"Celular"=>$fila[8],"condicion_de_pago"=>$fila[9]);
			}
			echo json_encode($salida);*/
		 


?>