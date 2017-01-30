<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id=$_POST["id"];
 	
	try{	 
			$sql="DELETE FROM formulas	
			WHERE id=".$id;
			$resultado2=mysql_query($sql,$conexion->link);

		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		