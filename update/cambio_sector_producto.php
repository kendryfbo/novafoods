<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_producto=$_POST["id_producto"];
	$id_sector=$_POST["id_sector"];
 	
	try{
			$sql1="UPDATE productos	 
				set 		 
				id_sector_producto=".$id_sector."
				where id_producto=".$id_producto;
			$resultado2=mysql_query($sql1,$conexion->link);
			echo $sql1;
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		