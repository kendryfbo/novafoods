<?php
	$id_proveedor_internacional=$_GET["id_proveedor_internacional"];
	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
        /*$sql1="select 
			nombre_proveedor,
			direccion,
			telefono,
			giro,
			Contacto,
			email,
			condicion_de_pago,
			rut
			from proveedores_internacionales 
			where id_proveedor=".$id_proveedor_internacional;*/
	$sql1="select 
			proveedor.nombre,
			proveedor.direccion,
			proveedor.fono,
			proveedor.giro,
			proveedor.contacto1,
			proveedor.mail1,
                        condiciones_pago.Condicion,
			proveedor.fax,
                        proveedor.celular,
                        proveedor.contacto2,
                        proveedor.mail2
			from proveedor
                        inner join condiciones_pago on condiciones_pago.id_condicion=proveedor.cond_pago
			where proveedor.id_proveedor=".$id_proveedor_internacional;
        /*$sql1="select 
			proveedor.nombre,
			proveedor.direccion,
			proveedor.fono,
			proveedor.giro,
			proveedor.contacto1,
			proveedor.mail1,
			condiciones_pago.Condicion,
			proveedor.fax,
                        cargos.cargo,
                        proveedor.celular,
                        proveedor.contacto2,
                        proveedor.mail2
			from proveedor
                        inner join condiciones_pago on condiciones_pago.id_condicion=proveedor.cond_pago
                        inner join cargos on cargos.id_cargo=proveedor.id_cargo
			where proveedor.id_proveedor=".$id_proveedor_internacional;*/
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
			while ($fila = mysql_fetch_array($ejecuta))
			{
				
			$salida[]=array("nombre"=>utf8_encode($fila[0]),"direccion"=>$fila[1],"fono"=>$fila[2],"giro"=>$fila[3],"Contacto"=>$fila[4]
				,"email"=>$fila[5],"condicion_de_pago"=>$fila[6],"fax"=>$fila[7],"cel"=>$fila[8],"cont2"=>$fila[9],"mail2"=>$fila[10]);
                        /*$salida[]=array("nombre"=>utf8_encode($fila[0]),"direccion"=>$fila[1],"fono"=>$fila[2],"giro"=>$fila[3],"Contacto"=>$fila[4]
				,"email"=>$fila[5],"condicion_de_pago"=>$fila[6],"fax"=>$fila[7],"carg"=>$fila[8],"cel"=>$fila[9],"cont2"=>$fila[10],"mail2"=>$fila[11]);*/
			}
			echo json_encode($salida);
	 
		 


?>