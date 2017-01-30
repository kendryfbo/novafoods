<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 
	$familia=trim($_POST["familia"]);
	$cod_familia=trim($_POST["cod_familia"]);
	$id_sector=trim($_POST["id_sector"]);
	
	try{		
			mysql_query("SET NAMES 'utf8'");
			$sql3="INSERT INTO familias (familia,codigo_familia,id_sector_producto)
				VALUES ('$familia','$cod_familia','$id_sector')";
 			$resultado=mysql_query($sql3,$conexion->link);
		
			echo "Familia Ingresada";

		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		