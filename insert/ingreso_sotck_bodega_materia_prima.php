<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 
	$num_orden_compra=trim($_POST["num_orden_compra"]);
 
	
	try{		
		 
			$sql="INSERT INTO bodega_central
					SELECT * FROM calidad where numero_orden_compra=".$num_orden_compra." and cantidad>0";
 			$resultado=mysql_query($sql,$conexion->link);
 


			$sql1="delete from calidad where numero_orden_compra=".$num_orden_compra;
 			$resultado1=mysql_query($sql1,$conexion->link);
		
		 

		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		