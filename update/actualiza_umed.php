<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_umed=$_POST["id_umed"];
 	$umed=trim($_POST["umed"]);
	
	try{
			$sql1="UPDATE umed	 
				set 		 
				umed='".utf8_decode($umed)."'
				where id_umed=".$id_umed;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Unidad de Medida Actualizada";
		
		 
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		