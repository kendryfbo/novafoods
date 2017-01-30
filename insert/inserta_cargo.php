<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$cargo=trim($_POST["cargo"]);
 	
	try{		
			mysql_query("SET NAMES 'utf8'");
			$sql3="INSERT INTO cargos (cargo)
				VALUES ('$cargo')";
 			$resultado=mysql_query($sql3,$conexion->link);
		
			echo "Cargo de Empresa Ingresado";

		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		