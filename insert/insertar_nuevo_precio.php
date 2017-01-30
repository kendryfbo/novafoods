<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 
	$precio_nuevo=trim($_POST["precio_nuevo"]);	 
	$id_producto=trim($_POST["id_producto"]);	
	
	  try{
				
								
				$id_con_pago=mysql_insert_id();

				$sql1="UPDATE productos	 
				set 		 
				costo_unitario='".$precio_nuevo."'
				where id_producto=".$id_producto;
				$resultado2=mysql_query($sql1,$conexion->link);

				
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		