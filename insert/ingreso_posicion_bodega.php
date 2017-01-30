<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$valor_de_posicion=trim($_POST["valor_de_posicion"]);
	$numero_altillo=trim($_POST["numero_altillo"]);
	$lugar=trim($_POST["lugar"]);
 	
	try{		
			mysql_query("SET NAMES 'utf8'");
			$sql3="INSERT INTO altillo_lugares (id_altillo,lugar_altillo,posicion)
				VALUES ('$numero_altillo','$lugar','$valor_de_posicion')";
 			$resultado=mysql_query($sql3,$conexion->link);
		
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		