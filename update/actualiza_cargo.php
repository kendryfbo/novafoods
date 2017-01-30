<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$cargo=$_POST["cargo"];
 	$id_cargo=trim($_POST["id_cargo"]);
	
	try{
			$sql1="UPDATE cargos	 
				set 		 
				cargo='".utf8_decode($cargo)."'
				where id_cargo=".$id_cargo;

			$resultado2=mysql_query($sql1,$conexion->link);
	
			echo "Cargo Actualizado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
				
?>		