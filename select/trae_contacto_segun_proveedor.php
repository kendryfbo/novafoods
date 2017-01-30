	<?php
	$id_proveedor=$_POST["id_proveedor"];
	$id_tipo_proveedor=$_POST["id_tipo_proveedor"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();


	if ($id_tipo_proveedor==1)
 	{
		
		$sql1="select rut,contacto1 from proveedor 
			WHERE id_proveedor =".$id_proveedor;
 		//$sql1="select rut_proveedor,contacto from proveedores_nacionales WHERE id_proveedor =".$id_proveedor; 	
			$ejecuta=mysql_query($sql1,$conexion->link);

			while ($fila = mysql_fetch_array($ejecuta))
			{
				$salida[]=array("rut_proveedor"=>$fila[0],"contacto"=>utf8_encode($fila[1]));

			}
			echo json_encode($salida);
	  
		
	}	
	else
	{
		$sql1="select proveedor.rut,
                    proveedor.contacto1,
                    condiciones_pago.Condicion
                    from proveedor 
                    inner join condiciones_pago on condiciones_pago.id_condicion=proveedor.cond_pago
			WHERE id_proveedor =".$id_proveedor;
                //$sql1="select contacto from proveedores_internacionales WHERE id_proveedor =".$id_proveedor;
 		 	
			$ejecuta=mysql_query($sql1,$conexion->link);
 
			while ($fila = mysql_fetch_array($ejecuta))
			{
				
				//$fila="No Registra";
                                if($fila[0]==null){
                                    $r="**-**";
                                }else{
                                    $r=$fila[0];
                                }
				$salida[]=array("rut"=>$r,"contacto"=>utf8_encode($fila[1]),"condicion_de_pago"=>$fila[2]);

			}
			echo json_encode($salida);
 
	 
	} 


?>