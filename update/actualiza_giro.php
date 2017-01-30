<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$giro=$_POST["giro"];
 	$id_giro=trim($_POST["id_giro"]);
	
	try{
			$sql1="UPDATE giros	 
				set 		 
				giro='".utf8_decode($giro)."'
				where id_giro=".$id_giro;

			$resultado2=mysql_query($sql1,$conexion->link);
	
			echo "Giro Actualizado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		