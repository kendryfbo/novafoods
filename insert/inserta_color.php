<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$color=trim($_POST["color"]);
	
	try{		
			mysql_query("SET NAMES 'utf8'");
			$sql3="INSERT INTO colores (color)
			VALUES ('$color')";
			$resultado=mysql_query($sql3,$conexion->link);
								
			echo "Color ha sido Ingresado";
			
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		