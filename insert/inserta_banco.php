<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$banco=trim($_POST["banco"]);
	
	try{		
			mysql_query("SET NAMES 'utf8'");
			$sql3="INSERT INTO bancos (banco)
			VALUES ('$banco')";
			$resultado=mysql_query($sql3,$conexion->link);
								
			echo "Banco ha sido Ingresado";
			
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		