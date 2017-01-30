<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$umed=trim($_POST["umed"]);
	 try{		
			mysql_query("SET NAMES 'utf8'");
			$sql3="INSERT INTO umed (umed)
			VALUES ('$umed')";
			$resultado=mysql_query($sql3,$conexion->link);
							
			echo "Unidad de Medidad ha sido Ingresada";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
				
?>		