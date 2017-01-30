<?php
	$id_cliente=$_GET["id_cliente"];
	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
        /*$sql1="select 
			nombre_cliente,
			rut,
			direccion,
			fono,
			fax,
			contacto,
			email,
			credito_maximo
			from cliente_nacional 
			where id_cliente=".$id_cliente;
         */
	$sql1="select 
			nombre,
			rut ,
			telefono,
			fax,
			c1,
			m1,
			credito,
                        habilitado
			from cliente
			where id_cliente=".$id_cliente;
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
			while ($fila = mysql_fetch_array($ejecuta))
			{
				
			$salida[]=array("nombre"=>utf8_encode($fila[0]),"rut"=>$fila[1],"telefono"=>$fila[2]
				,"fax"=>$fila[3],"c1"=>$fila[4],"m1"=>$fila[5],"credito"=>$fila[6],"habil"=>$fila[7]);
			}
			echo json_encode($salida);
	 
		 


?>