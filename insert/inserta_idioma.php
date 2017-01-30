<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$idioma=trim($_POST["idioma"]);
 	
	try{		
			mysql_query("SET NAMES 'utf8'");
			$sql3="INSERT INTO idiomas (idioma)
				VALUES ('$idioma')";
 			$resultado=mysql_query($sql3,$conexion->link);
		
			echo "Idioma Ingresado";

		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		