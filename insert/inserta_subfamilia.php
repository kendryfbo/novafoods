<?php	 


	include_once("../clases/conexion.php");
	$conexion= new conexion();
 
	$subfamilia=trim($_POST["subfamilia"]);
	$id_familia=trim($_POST["id_familia"]);
	
	
	
	
	  try{
				$sql3="INSERT INTO sub_familias (id_familia,sub_familia)
				VALUES ('$id_familia','$subfamilia')";
 
				$resultado=mysql_query($sql3,$conexion->link);
								
								
				echo "SubFamilia  Ingresada";

		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		