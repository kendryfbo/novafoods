<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$canal_=trim($_POST["canal"]);
        $desc_=trim($_POST["desc"]);
        
	//$canal=trim($_POST["canal"]);
        //$desc=trim($_POST["desc"]);

	
	//$credito = str_replace(".", "", $credito);
	 try{		
			mysql_query("SET NAMES 'utf8'");
			$sql3="INSERT INTO canales (canal ,Desc)
				VALUES ('$canal_','$desc_')";
				$resultado=mysql_query($sql3,$conexion->link);
				echo "Canal Ingresado";

		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		