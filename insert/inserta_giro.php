<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$giro=trim($_POST["giro"]);
 	
	try{		
			mysql_query("SET NAMES 'utf8'");
			$sql3="INSERT INTO giros (giro)
				VALUES ('$giro')";
 			$resultado=mysql_query($sql3,$conexion->link);
		
			echo "Giro de Empresa Ingresado";

		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		