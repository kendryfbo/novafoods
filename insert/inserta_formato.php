<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$formato=trim($_POST["formato"]);
	$dis=trim($_POST["dis"]);
        $sob=trim($_POST["sob"]);
        $con=trim($_POST["con"]);
        $list_umed=trim($_POST["list_umed"]);
        
	try{		
			mysql_query("SET NAMES 'utf8'");
			$sql3="INSERT INTO formatos (formato,display,sobre,contenido,umed)
			VALUES ('$formato','$dis','$sob','$con','$list_umed')";
			$resultado=mysql_query($sql3,$conexion->link);
								
			echo "Formato ha sido Ingresada";
			
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		