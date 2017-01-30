<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$talla=trim($_POST["talla"]);	
	  try{		
				mysql_query("SET NAMES 'utf8'");
				$sql3="INSERT INTO tallas (talla)
				VALUES ('$talla')";
				$resultado=mysql_query($sql3,$conexion->link);
								
				echo "Talla Ingresada";

				
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		