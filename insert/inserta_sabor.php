<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 
	$sabor_esp=trim($_POST["sabor_esp"]);
	$sabor_ing=trim($_POST["sabor_ing"]);
	
	try{		
			mysql_query("SET NAMES 'utf8'");
			$sql3="INSERT INTO sabores (sabor_espanol,sabor_ingles)
				VALUES ('$sabor_esp','$sabor_ing')";
 			$resultado=mysql_query($sql3,$conexion->link);
		
			echo "Sabor Ingresado";
		 
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		