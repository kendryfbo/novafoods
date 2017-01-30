<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$precio=trim($_POST["precio"]);
	$cajas=trim($_POST["cajas"]);
	$id_producto=trim($_POST["id_producto"]);
	
	$numero_oc=trim($_POST["numero_oc"]);	
        
		try{	
				$total=($precio*$cajas);
                                

				$sql3="INSERT INTO detalle_oc (Cantidad,id_producto,Precio,total,id_oc)
					VALUES ('$cajas','$id_producto','$precio','$total','$numero_oc')";
                                
				$resultado=mysql_query($sql3,$conexion->link);
                                
                                $sql4="update productos set costo_unitario='$precio' where id_producto=".$id_producto;
                                $resultado4=mysql_query($sql4,$conexion->link);
                                
				$id_detalle_nota_venta=mysql_insert_id();
				$cantidad=$cajas*-1;

			
			}
				catch (Exception $e)
			{    
				 echo $e->getMessage();
			}
	//}			
?>		