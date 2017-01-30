<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_producto_terminado=$_POST["id_producto_terminado"];
 	
	
	try{
			$sql1="UPDATE formulas	 
				set 		 
				status='1'
				where id_producto_padre=".$id_producto_terminado;

			$resultado2=mysql_query($sql1,$conexion->link);
	
			echo "Formula Aprobada por Desarrollo!";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		