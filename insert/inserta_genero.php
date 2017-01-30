<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$genero=trim($_POST["genero"]);	
	try{		
			mysql_query("SET NAMES 'utf8'");
			$sql3="INSERT INTO generos (genero)
			VALUES ('$genero')";
			$resultado=mysql_query($sql3,$conexion->link);
								
			echo "Genero ha sido Ingresado";
			
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		