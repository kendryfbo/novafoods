<?php	 
	
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_subfamilia=$_POST["id_subfamilia"];
	$id_familia=$_POST["id_familia"];
 	$subfamilia=trim($_POST["subfamilia"]);
	
	try{
			$sql1="UPDATE sub_familias	 
				set 		 
				id_familia='".$id_familia."',
				sub_familia='".$subfamilia."'
				where id_subfamilia=".$id_subfamilia;
			$resultado2=mysql_query($sql1,$conexion->link);
		
			echo "SubFamilia Actualizada";
	 
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}


					
?>	