<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$material=trim($_POST["material"]);
	
	try{		
			mysql_query("SET NAMES 'utf8'");
			$sql3="INSERT INTO materiales (material)
			VALUES ('$material')";
			$resultado=mysql_query($sql3,$conexion->link);
								
			echo "Material ha sido Ingresado";
			
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		